<?php

namespace App\Mail;

use App\Models\OrderReturn;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReturnStatusUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public OrderReturn $return)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your return request for order '.$this->return->order->order_number.' is now '.ucfirst($this->return->status),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.return-status-updated',
            with: ['return' => $this->return],
        );
    }
}
