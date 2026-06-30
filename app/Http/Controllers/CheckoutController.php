<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderAdmin;
use App\Mail\OrderPlaced;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    private const FREE_SHIPPING_THRESHOLD = 75.0;
    private const FLAT_SHIPPING_RATE = 4.99;

    public function index(Request $request)
    {
        $items = Cart::instance('cart')->content();

        if ($items->count() === 0) {
            return redirect()->route('cart.index');
        }

        $subtotal = (float) Cart::instance('cart')->subtotal(2, '.', '');
        $shipping = $this->shippingFee($subtotal);
        $coupon = $this->sessionCoupon();
        $discount = $this->discountFor($coupon, $subtotal);
        $total = max(0, $subtotal + $shipping - $discount);

        return view('checkout', compact('items', 'subtotal', 'shipping', 'discount', 'coupon', 'total'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string|max:50']);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (! $coupon || ! $coupon->isValid()) {
            return back()->withErrors(['code' => 'This coupon code is invalid or expired.']);
        }

        session(['coupon_code' => $coupon->code]);

        return back()->with('success', 'Coupon applied successfully.');
    }

    public function removeCoupon()
    {
        session()->forget('coupon_code');

        return back()->with('success', 'Coupon removed.');
    }

    public function store(Request $request)
    {
        $items = Cart::instance('cart')->content();

        if ($items->count() === 0) {
            return redirect()->route('cart.index');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:cod,bank_transfer',
        ]);

        try {
            $order = DB::transaction(function () use ($request, $items) {
                // Lock the product rows so concurrent checkouts can't oversell the same stock.
                $productIds = $items->pluck('id')->all();
                $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

                foreach ($items as $item) {
                    $product = $products->get($item->id);

                    if (! $product || $product->quantity < $item->qty) {
                        throw ValidationException::withMessages([
                            'stock' => 'Sorry, "'.$item->name.'" no longer has enough stock available.',
                        ]);
                    }
                }

                $subtotal = (float) Cart::instance('cart')->subtotal(2, '.', '');
                $shipping = $this->shippingFee($subtotal);
                $coupon = $this->sessionCoupon();
                $discount = $this->discountFor($coupon, $subtotal);
                $total = max(0, $subtotal + $shipping - $discount);

                $order = Order::create([
                    'order_number' => 'VW-'.now()->format('ymd').'-'.strtoupper(Str::random(6)),
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'country' => $request->country,
                    'notes' => $request->notes,
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'discount' => $discount,
                    'coupon_code' => $coupon?->code,
                    'total' => $total,
                    'payment_method' => $request->payment_method,
                    'status' => 'pending',
                ]);

                foreach ($items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->id,
                        'name' => $item->name,
                        'price' => $item->price,
                        'quantity' => $item->qty,
                    ]);

                    $product = $products->get($item->id);
                    $remaining = max(0, $product->quantity - $item->qty);
                    $product->quantity = $remaining;
                    $product->stock_status = $remaining > 0 ? 'instock' : 'outofstock';
                    $product->save();
                }

                if ($coupon) {
                    $coupon->increment('times_used');
                }

                return $order;
            });
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        Cart::instance('cart')->destroy();
        session()->forget('coupon_code');

        $order->load('items');
        Mail::to($order->email)->send(new OrderPlaced($order));

        $adminEmails = User::where('utype', 'ADM')->pluck('email');
        if ($adminEmails->isNotEmpty()) {
            Mail::to($adminEmails->all())->send(new NewOrderAdmin($order));
        }

        return redirect()->route('checkout.confirmation', $order->order_number)
            ->with('success', 'Your order has been placed successfully.');
    }

    public function confirmation($order_number)
    {
        $order = Order::with('items')->where('order_number', $order_number)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('order-confirmation', compact('order'));
    }

    private function shippingFee(float $subtotal): float
    {
        return $subtotal >= self::FREE_SHIPPING_THRESHOLD ? 0.0 : self::FLAT_SHIPPING_RATE;
    }

    private function sessionCoupon(): ?Coupon
    {
        $code = session('coupon_code');

        if (! $code) {
            return null;
        }

        $coupon = Coupon::where('code', $code)->first();

        return $coupon && $coupon->isValid() ? $coupon : null;
    }

    private function discountFor(?Coupon $coupon, float $subtotal): float
    {
        if (! $coupon) {
            return 0.0;
        }

        return $coupon->type === 'percent'
            ? round($subtotal * ($coupon->value / 100), 2)
            : min($coupon->value, $subtotal);
    }
}
