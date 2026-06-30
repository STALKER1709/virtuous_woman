<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        return view('cart', compact('items'));
    }

    public function add_to_cart(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1|max:100',
            'variant_id' => 'nullable|integer|exists:product_variants,id',
        ]);

        $product = Product::findOrFail($request->id);
        $variant = null;

        if ($request->filled('variant_id')) {
            $variant = ProductVariant::where('id', $request->variant_id)->where('product_id', $product->id)->firstOrFail();

            if ($variant->quantity < $request->quantity) {
                return redirect()->back()->withErrors(['stock' => 'This product variant is currently out of stock.']);
            }
        } elseif ($product->stock_status !== 'instock' || $product->quantity < 1) {
            return redirect()->back()->withErrors(['stock' => 'This product is currently out of stock.']);
        }

        $price = $product->sale_price ?: $product->regular_price;

        Cart::instance('cart')->add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->quantity,
            'price' => $price,
            'options' => [
                'variant_id' => $variant?->id,
                'size' => $variant?->size,
                'color' => $variant?->color,
            ],
        ])->associate('App\Models\Product');

        return redirect()->back()->with('success_message', 'Item added to cart!');
    }

    public function increase_cart_quantity($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        $qty = $item->qty + 1;

        if ($variantId = $item->options->get('variant_id')) {
            $variant = ProductVariant::find($variantId);

            if ($variant && $qty > $variant->quantity) {
                return redirect()->back()->withErrors(['stock' => 'No more stock available for this item.']);
            }
        } else {
            $product = Product::find($item->id);

            if ($product && $qty > $product->quantity) {
                return redirect()->back()->withErrors(['stock' => 'No more stock available for this item.']);
            }
        }

        Cart::instance('cart')->update($rowId,['qty'=>$qty]);
        return redirect()->back();
    }
    public function decrease_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,['qty'=>$qty]);
        return redirect()->back();
    }
    public function remove_item($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();
    }

    public function clear_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }
}
