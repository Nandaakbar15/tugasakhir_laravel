<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notificationContent;

    /**
     * Create a new message instance.
     */
    public function __construct($notificationContent)
    {
        $this->notificationContent = $notificationContent;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Anda mendapatkan notifikasi dari pelanggan')
                    ->view('emails.notification');
    }
}
