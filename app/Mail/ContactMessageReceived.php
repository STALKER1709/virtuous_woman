<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public string $name, public string $email, public string $subject, public string $body)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact form: '.$this->subject,
            replyTo: [$this->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-message',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'subjectLine' => $this->subject,
                'body' => $this->body,
            ],
        );
    }
}
