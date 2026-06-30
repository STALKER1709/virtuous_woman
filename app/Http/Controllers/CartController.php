<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        ]);

        $product = Product::findOrFail($request->id);

        if ($product->stock_status !== 'instock' || $product->quantity < 1) {
            return redirect()->back()->withErrors(['stock' => 'This product is currently out of stock.']);
        }

        $price = $product->sale_price ?: $product->regular_price;

        Cart::instance('cart')->add($product->id, $product->name, $request->quantity, $price)->associate('App\Models\Product');
        return redirect()->back()->with('success_message', 'Item added to cart!');
    }

    public function increase_cart_quantity($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        $product = Product::find($item->id);
        $qty = $item->qty + 1;

        if ($product && $qty > $product->quantity) {
            return redirect()->back()->withErrors(['stock' => 'No more stock available for this item.']);
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
