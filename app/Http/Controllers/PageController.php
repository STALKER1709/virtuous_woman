<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageReceived;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $adminEmails = User::where('utype', 'ADM')->pluck('email');
        $recipients = $adminEmails->isNotEmpty() ? $adminEmails->all() : [config('mail.from.address')];

        Mail::to($recipients)->send(new ContactMessageReceived(
            $request->name,
            $request->email,
            $request->subject,
            $request->message
        ));

        return back()->with('success', __('messages.contact_success'));
    }
}
