<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Wishlist;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function order_invoice($order_number)
    {
        $order = Order::with('items')->where('order_number', $order_number)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pdf = Pdf::loadView('invoices.order', compact('order'));

        return $pdf->download('invoice-'.$order->order_number.'.pdf');
    }

    public function exportData()
    {
        $user = Auth::user();

        $data = [
            'account' => $user->only(['name', 'email', 'mobile', 'created_at']),
            'orders' => Order::with('items')->where('user_id', $user->id)->get()->toArray(),
            'wishlist' => Wishlist::with('product')->where('user_id', $user->id)->get()->toArray(),
            'reviews' => Review::where('user_id', $user->id)->get()->toArray(),
        ];

        $fileName = 'virtuous-woman-data-export-'.now()->format('Ymd-His').'.json';

        return response()->json($data)->header('Content-Disposition', 'attachment; filename="'.$fileName.'"');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate(['password' => 'required|current_password']);

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index')->with('success', 'Your account and personal data have been deleted.');
    }
}
