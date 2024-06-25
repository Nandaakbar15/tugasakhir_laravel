<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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
        $email = $this->view('emails.notification')
                    ->with('notificationContent', $this->notificationContent);


        // Embed console image
        // $consoleImagePath = $this->notificationContent['foto'];
        // $consoleImageContent = Storage::get($consoleImagePath);
        // $email->attachData($consoleImageContent, basename($consoleImagePath), [
        //     'mime' => Storage::mimeType($consoleImagePath)
        // ]);

        // // Embed game images
        // if (!empty($this->notificationContent['game_list'])) {
        //     foreach ($this->notificationContent['game_list'] as $game) {
        //         $gameImagePath = $game['foto'];
        //         $gameImageContent = Storage::get($gameImagePath);
        //         $email->attachData($gameImageContent, basename($gameImagePath), [
        //             'mime' => Storage::mimeType($gameImagePath)
        //         ]);
        //     }
        // }

        return $email;
    }
}
