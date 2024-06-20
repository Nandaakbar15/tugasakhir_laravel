<?php

namespace App\Jobs;

use App\Mail\CustomerNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCustomerNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public $notificationContent;

    public function __construct($notificationContent)
    {
        $this->notificationContent = $notificationContent;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('gplaystation021@gmail.com')->send(new CustomerNotificationMail($this->notificationContent));
    }
}
