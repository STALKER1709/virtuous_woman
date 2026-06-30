<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();

        if ($items->count() === 0) {
            return redirect()->route('cart.index');
        }

        return view('checkout', compact('items'));
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

        $order = DB::transaction(function () use ($request, $items) {
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
                'subtotal' => Cart::instance('cart')->subtotal(2, '.', ''),
                'shipping' => 0,
                'total' => Cart::instance('cart')->total(2, '.', ''),
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

                $product = Product::find($item->id);
                if ($product) {
                    $remaining = max(0, $product->quantity - $item->qty);
                    $product->quantity = $remaining;
                    $product->stock_status = $remaining > 0 ? 'instock' : 'outofstock';
                    $product->save();
                }
            }

            return $order;
        });

        Cart::instance('cart')->destroy();

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
}
