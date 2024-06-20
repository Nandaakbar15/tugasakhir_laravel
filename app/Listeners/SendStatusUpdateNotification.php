<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\ServiceStatusUpdated;
use App\Mail\StatusUpdateNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;

class SendStatusUpdateNotification
{

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $antrian = $event->antrian;
        $user = $antrian->user;

        Mail::to($user->email)->send(new StatusUpdateNotification($antrian));
    }
}
