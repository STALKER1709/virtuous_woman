<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->get();

        return view('user.wishlist', compact('wishlist'));
    }

    public function toggle(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            $existing->delete();
            $added = false;
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ]);
            $added = true;
        }

        if ($request->wantsJson()) {
            return response()->json(['added' => $added]);
        }

        return back()->with('success', $added ? 'Added to wishlist.' : 'Removed from wishlist.');
    }
}
