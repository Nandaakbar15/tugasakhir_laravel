<?php

namespace App\Listeners;

use App\Events\ServiceStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Twilio\Rest\Client;
use App\Models\Antrian;


class SendWhatsAppMessage implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ServiceStatusUpdated $event)
    {
        $antrian = $event->antrian;

        $sid    = "ACa65b856b3a980c9f55efaac35592368d";
        $token  = "b66e68bbc7fc3a5ae4b79b80ef534fe5";
        $twilio = new Client($sid, $token);

        try {
            $twilio->messages->create("whatsapp:+6281818132011", [
                'from' => 'whatsapp:+14155238886',
                'body' => "Halo! Teknisi sudah memperbaiki konsolmu! Terima kasih!",
            ]);

            return redirect('/dashboard')->with('success', 'Pesan terkirim!');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
