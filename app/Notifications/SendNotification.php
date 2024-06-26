<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Notifikasi;

class SendNotification extends Notification
{
    use Queueable;

    protected $notifikasi;
    protected $recipientEmail;

    /**
     * Create a new notification instance.
     */
    public function __construct($notifikasi, $recipientEmail)
    {
        $this->notifikasi = $notifikasi;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Anda mendapatkan Notifikasi dari pelanggan!')
                    ->line($this->notifikasi->pelanggan->email)
                    ->line($this->notifikasi->isi_notifikasi)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
