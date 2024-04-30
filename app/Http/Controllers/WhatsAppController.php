<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendMessage()
    {
        $sid    = "ACa65b856b3a980c9f55efaac35592368d";
        $token  = "b66e68bbc7fc3a5ae4b79b80ef534fe5";
        $twilio = new Client($sid, $token);

        try {
            $twilio->messages->create("whatsapp:+6281818132011", [
                'from' => 'whatsapp:+14155238886',
                'body' => "Halo! Konsolmu sedang dalam proses servis oleh teknisi, mohon di tunggu ya!",
            ]);

            return redirect('/dashboard')->with('success', 'Pesan terkirim!');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
