<?php

namespace App\Http\Controllers;

use App\Mail\NewReturnAdmin;
use App\Models\Order;
use App\Models\OrderReturn;
use App\Models\Review;
use App\Models\User;
use App\Models\Wishlist;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $order = Order::with(['items', 'orderReturn'])->where('order_number', $order_number)
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

    public function returnRequest(Request $request, $order_number)
    {
        $order = Order::with('items')->where('order_number', $order_number)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        abort_unless($order->status === 'delivered', 403);
        abort_unless($order->updated_at->diffInDays(now()) <= 14, 403);
        abort_if($order->orderReturn()->exists(), 403);

        $request->validate([
            'reason' => 'required|string|max:2000',
        ]);

        $return = OrderReturn::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            'status' => 'requested',
        ]);

        $adminEmails = User::where('utype', 'ADM')->pluck('email');
        $recipients = $adminEmails->isNotEmpty() ? $adminEmails->all() : [config('mail.from.address')];
        Mail::to($recipients)->send(new NewReturnAdmin($return));

        return redirect()->route('user.order.details', $order->order_number)
            ->with('success', __('messages.return_request_success'));
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
