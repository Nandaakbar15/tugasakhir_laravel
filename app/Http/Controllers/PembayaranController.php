<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;
use App\Models\Antrian;
use App\Models\Pembayaran;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Snap;
class PembayaranController extends Controller
{
    public function viewpembayaran() // view menu pembayaran
    {

        // $user = Auth::user();

        // $payments = $user->pembayaran;

        $pelanggan = Pelanggan::all();
        $antrian = Antrian::all();
        $pembayaran = Pembayaran::all();
        return view('dashboardpelanggan.pembayaran.viewpembayaran', [
            // 'payments' => $payments,
            'pelanggan' => $pelanggan,
            'pembayaran' => $pembayaran,
            'antrian' => $antrian,
        ]);

        // return view('dashboardpelanggan.pembayaran.viewpembayaran');
    }

    public function showCheckout(Request $request) // view detail pembayaran
    {
        // Retrieve payment_token from the request
        $payment_token = $request->input('payment_token');

        $pelanggan = Pelanggan::find($request->input('id_pelanggan'));
        $pembayaran = Pembayaran::find($request->input('id_pembayaran'));
        $antrian = Antrian::find($request->input('id_antrian'));
        $jumlah_pembayaran = $pembayaran->jumlah_pembayaran;

        if (!$pelanggan || !$antrian) {
            return back()->with('error', 'Pelanggan or Antrian not found.');
        }

        // Pass payment_token to the checkout view
        return view('dashboardpelanggan.pembayaran.checkout', [
            'payment_token' => $payment_token,
            'pelanggan' => $pelanggan,
            'antrian' => $antrian,
            'pembayaran' => $pembayaran,
            'jumlah_pembayaran' => $jumlah_pembayaran,
        ]);
    }

    public function bayar(Request $request) // logic / implementasi pembayaran dengan midtrans
    {
        $id_pelanggan = $request->input("id_pelanggan");
        $id_antrian = $request->input("id_antrian");
        $nama = $request->input("nama");
        $email = $request->input("email");
        $no_telp = $request->input("no_telp");
        $jumlah_pembayaran = $request->input('jumlah_pembayaran');

        $pelanggan = Pelanggan::find($id_pelanggan);
        $antrian = Antrian::find($id_antrian);

        $pembayaran = new Pembayaran();
        $pembayaran->id_pelanggan = $id_pelanggan;
        $pembayaran->id_antrian = $id_antrian;
        $pembayaran->nama = $nama;
        $pembayaran->email =  $email;
        $pembayaran->no_telp = $no_telp;
        $pembayaran->jumlah_pembayaran = $jumlah_pembayaran;
        $pembayaran->tgl_pembayaran = now();
        $pembayaran->status = 'paid';
        $pembayaran->save(); // pas masukin pembayarannya ini masuk ke database dan statusnya defaultnya paid

        Config::$serverKey = config('midtrans.server_key'); // ambil server key dari midtrans
        Config::$clientKey = config('midtrans.client_key'); // ambil client key dari midtrans
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false; // kalo pake production ubah nilainya ke true
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $gross_amount = $jumlah_pembayaran * 500000;

        $transaction_details = [
            'order_id' => 'ORDER-' . uniqid(), // Generate a unique order ID
            'gross_amount' => $gross_amount, // Set the transaction amount
        ];

         // Set customer details
        $customer_details = [
            'first_name' => $pembayaran->nama, // first namenya ambil dari nama pelanggan
            'email' => $pembayaran->email, // email dari database pelanggan
            'phone' => $pembayaran->no_telp, // no telp dari database pelanggan juga
        ];

        // Set item details (optional)
        $item_details = [
            [
                'id' => $antrian->id_antrian,
                'price' => $jumlah_pembayaran,
                'quantity' => 1,
                'name' => 'Servis PlayStation', // Name of the product/service
            ],
        ];

        // Set additional data (optional)
        $custom_field = [
            'id_pelanggan' => $id_pelanggan,
            'id_antrian' => $id_antrian,
        ];

       $payment_token = Snap::getSnapToken([
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details,
                'item_details' => $item_details,
                'custom_field1' => $custom_field['id_pelanggan'], // Example of passing custom fields
                'custom_field2' => $custom_field['id_antrian'],
        ]);



        // redirect ke view detail pembayaran atau checkout
        // kalau misalkan udah masukin form pembayarannya langsung ke halaman detail pembayarannya
        return view('dashboardpelanggan.pembayaran.checkout', compact('payment_token', 'pelanggan', 'antrian', 'pembayaran', 'jumlah_pembayaran'));
    }
}
