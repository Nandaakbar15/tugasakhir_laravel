<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerNotificationMail;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Antrian;
use App\Models\Kendala;
use App\Models\Konsol;
use App\Models\Teknisi;
use App\Models\ProfilToko;
use App\Models\Notifikasi;


class PelangganApiController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        $data = [
            'pelanggan' => $pelanggan
        ];
        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([ // validasi data
        'nama_pelanggan' => 'required|max:50',
        'alamat' => 'required',
        'no_telp' => 'required|max:30',
        'email' => 'required|max:30',
        'nama_konsol' => 'required|max:50',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'kendala_kerusakan' => 'required|max:35',
        ]);

        $pelanggan = Pelanggan::create([ // isi data pribadi pelanggan
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
        ]);

        $teknisi = Teknisi::first();

        $recipientEmail = 'gplaystation021@gmail.com';

        // $gameList = session()->get('game', []); // ambil session game

        // $gameListContent = []; // variabel dengan array kosong yang nantinya buat nampung data game

        // foreach ($gameList as $game) { // looping list game
        //     $gameListContent[] = [ // data2 game yang di fetch
        //         "id_game" => $game["id_game"],
        //         "nama_game" => $game["nama_game"],
        //         "developer" => $game["developer"],
        //         "tgl_rilis" => $game["tgl_rilis"],
        //         "platform" => $game["platform"],
        //         "foto" => $game["foto"]
        //     ];
        // }

        $notificationContent = [ // isi notifikasi
            "nama_pelanggan" => $request->nama_pelanggan,
            "alamat" => $request->alamat,
            "email" => $request->email,
            "no_telp" => $request->no_telp,
            "nama_konsol" =>  $request->nama_konsol,
            "kendala_kerusakan" => $request->kendala_kerusakan,
            // "game_list" => $gameListContent
        ];

        Notifikasi::create([ // nambahin data notifikasi ke database
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_teknisi' => $teknisi->id_teknisi,
            'isi_notifikasi' => json_encode($notificationContent)
        ]);

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $fileName, 'public');

        $konsol = Konsol::create([ // Isi data konsol
            'nama_konsol' => $request->nama_konsol,
            'foto' => '/storage/' . $path,
            'id_pelanggan' => $pelanggan->id_pelanggan,
        ]);

        $antrian = new Antrian();
        $antrian->id_konsol = $konsol->id_konsol;
        $antrian->id_pelanggan = $pelanggan->id_pelanggan;
        $antrian->status_servis;
        $antrian->tgl_servis;
        $antrian->save();

        Kendala::create([ // isi kendala dan kerusakan konsol
            'kendala_kerusakan' => $request->kendala_kerusakan,
            'id_konsol' => $konsol->id_konsol,
        ]);

        Mail::to($recipientEmail)->send(new CustomerNotificationMail($notificationContent)); // kirim notifikasi ke teknisi
        // $user->notify(new SendNotification($isi_notifikasi));

        return response()->json([
            'statusCode' => 200,
            'message' => 'Data kamu berhasil terkirim ke teknisi!'
        ]);
    }

    public function statusservis()
    {
        $antrian = Antrian::with('user', 'konsol')->get();
        $data = [
            'antrian' => $antrian
        ];
        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function profil_toko()
    {
        $profilToko = ProfilToko::all();

        $data = [
            $profilToko
        ];

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }
}
