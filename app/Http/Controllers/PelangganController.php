<?php

namespace App\Http\Controllers;

use App\Mail\CustomerNotificationMail;
use App\Models\Antrian;
use App\Models\Kendala;
use App\Models\Pelanggan;
use App\Models\Konsol;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfilToko;
use App\Models\Notifikasi;
// use App\Notifications\SendNotification;
use App\Models\Teknisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // view dashboard untuk pelanggan
    {
        return view('dashboardpelanggan.layouts.home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboardpelanggan.servis.isidata'); // view untuk isi data
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // isi data logic
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

        return redirect('/pelanggan/dashboardpelanggan')->with('success', 'Data kamu sudah di kirim ke teknisi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan) // view untuk edit data pelanggan
    {
        return view('dashboard.datauser.ubahDataPelanggan', [
            'pelanggan' => $pelanggan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan) // logic edit
    {
        $validate = $request->validate([ // validasi data
            'nama_pelanggan' => 'required|max:50',
            'alamat' => 'required',
            'no_telp' => 'required|max:30',
            'email' => 'required|max:30',
        ]);

        $pelanggan->update($validate); // update data
        Pelanggan::where('id_pelanggan', $pelanggan->id_pelanggan)
             ->update($validate);

        return redirect('/dashboard')->with('success', 'Data Pelanggan berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        //
    }

    public function profiltoko() // view profil toko di dashboard pelanggan
    {
        $profilToko = ProfilToko::all();
        return view('dashboardpelanggan.layouts.abouts', [
            'profilToko' => $profilToko
        ]);

        // return view('dashboardpelanggan.layouts.abouts');
    }

    public function statusservis() // melihat status servis
    {
         // Retrieve the currently authenticated user
        $user = auth()->user();

        // Check if the user exists and is a pelanggan
        if ($user && $user->role === 'pelanggan') {
            // Retrieve the Antrian records associated with the user
            $antrian = $user->antrian;

            // If you want to eager load related Konsol data, you can do so here
            $antrian = $antrian->load('konsol');

            // Pass the user and Antrian records to the view
            return view('dashboardpelanggan.status_servis.viewstatus_servis', [
                'user' => $user,
                'antrian' => $antrian
            ]);
        } else {
            // Handle the case where the user is not a pelanggan
            return redirect()->back()->with('error', 'Unauthorized access');
        }
    }
}
