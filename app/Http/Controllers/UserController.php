<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->take(5)->get();

        return view('user.index', compact('orders'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(10);

        return view('user.orders', compact('orders'));
    }

    public function order_details($order_number)
    {
        $order = Order::with('items')->where('order_number', $order_number)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.order-details', compact('order'));
    }
}
