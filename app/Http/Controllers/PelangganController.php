<?php

namespace App\Http\Controllers;

use App\Mail\CustomerNotificationMail;
use App\Models\Antrian;
use App\Models\Kendala;
use App\Models\Pelanggan;
use App\Models\Konsol;
use Illuminate\Http\Request;
use App\Models\ProfilToko;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use App\Models\Teknisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    public function create(Request $request)
    {
        // session()->put([
        //     'nama_pelanggan' => $request->input('nama_pelanggan'),
        //     'alamat' => $request->input('alamat'),
        //     'no_telp' => $request->input('no_telp'),
        //     'email' => $request->input('email'),
        //     'nama_konsol' => $request->input('nama_konsol'),
        //     'kendala_kerusakan' => $request->input('kendala_kerusakan'),
        //     'foto' => $request->input('foto')
        // ]);

        $nama_pelanggan = session("nama_pelanggan");
        $alamat = session("alamat");
        $no_telp = session("no_telp");
        $email = session("email");
        $nama_konsol = session("nama_konsol");
        $foto = session('foto');
        $kendala_kerusakan = session("kendala_kerusakan");

        return view('dashboardpelanggan.servis.isidata', [
            'nama_pelanggan' => $nama_pelanggan,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'email' => $email,
            'nama_konsol' => $nama_konsol,
            'kendala_kerusakan' => $kendala_kerusakan,
            'foto' => $foto
        ]); // view untuk isi data
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // isi data logic
    {
        session()->put([
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'email' => $request->input('email'),
            'nama_konsol' => $request->input('nama_konsol'),
            'kendala_kerusakan' => $request->input('kendala_kerusakan'),
            'foto' => $request->input('foto')
        ]);

        ini_set('max_execution_time', 199);

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

        $gameList = session()->get('game', []); // ambil session game

        $gameListContent = []; // variabel dengan array kosong yang nantinya buat nampung data game

        foreach ($gameList as $game) { // looping list game
            $gameListContent[] = [ // data2 game yang di fetch
                "id_game" => $game["id_game"],
                "nama_game" => $game["nama_game"],
                "developer" => $game["developer"],
                "tgl_rilis" => $game["tgl_rilis"],
                "platform" => $game["platform"],
                "foto" => $game["foto"]
            ];
        }

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $fileName, 'public');
        $filePath = '/storage/' . $path;

        $konsol = Konsol::create([ // Isi data konsol
            'nama_konsol' => $request->nama_konsol,
            'foto' => '/storage/' . $path,
            // 'foto' => $localPath,
            'id_pelanggan' => $pelanggan->id_pelanggan,
        ]);

        $notificationContent = [ // isi notifikasi
            "nama_pelanggan" => $request->nama_pelanggan,
            "alamat" => $request->alamat,
            "email" => $request->email,
            "no_telp" => $request->no_telp,
            "nama_konsol" =>  $request->nama_konsol,
            "kendala_kerusakan" => $request->kendala_kerusakan,
            "foto" => $filePath,
            "game_list" => $gameListContent
        ];

        Notifikasi::create([ // nambahin data notifikasi ke database
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_teknisi' => $teknisi->id_teknisi,
            'isi_notifikasi' => json_encode($notificationContent)
        ]);

        $antrian = new Antrian();
        $antrian->id_konsol = $konsol->id_konsol;
        $antrian->id_pelanggan = $pelanggan->id_pelanggan;
        $antrian->nama_pelanggan = $pelanggan->nama_pelanggan;
        $antrian->email = $pelanggan->email;
        $antrian->status_servis;
        $antrian->tgl_servis;
        $antrian->save();

        Kendala::create([ // isi kendala dan kerusakan konsol
            'kendala_kerusakan' => $request->kendala_kerusakan,
            'id_konsol' => $konsol->id_konsol,
            'id_pelanggan' => $pelanggan->id_pelanggan
        ]);

        Mail::to($recipientEmail)->send(new CustomerNotificationMail($notificationContent)); // kirim notifikasi ke teknisi
        // SendCustomerNotification::dispatch($notificationContent);

        return redirect('/pelanggan/dashboardpelanggan')->with('success', 'Data kamu sudah di kirim ke teknisi!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan) // view untuk edit data pelanggan
    {
        $username = Auth::user()->name;
        return view('dashboard.datauser.ubahDataPelanggan', [
            'pelanggan' => $pelanggan,
            'username' => $username
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
    public function destroy(Pelanggan $pelanggan) // hapus data pelanggan
    {
        // Delete related pembayaran records first
        Pembayaran::where("id_pelanggan", $pelanggan->id_pelanggan)->delete();

        // Then delete related antrian records
        Antrian::where("id_pelanggan", $pelanggan->id_pelanggan)->delete();

        // Then delete related kendala records through konsol relationship
        $konsols = Konsol::where("id_pelanggan", $pelanggan->id_pelanggan)->get();
        foreach ($konsols as $konsol) {
            Kendala::where("id_konsol", $konsol->id_konsol)->delete();
        }

        // Finally delete related konsol records
        Konsol::where("id_pelanggan", $pelanggan->id_pelanggan)->delete();

        // Delete related notifikasi records
        Notifikasi::where("id_pelanggan", $pelanggan->id_pelanggan)->delete();

        // Delete the pelanggan record
        $pelanggan->delete();

        return redirect('/datauser')->with('success', 'Data Pelanggan Berhasil di hapus!');
    }

    public function profiltoko() // view profil toko di dashboard pelanggan
    {
        $profilToko = ProfilToko::all();
        return view('dashboardpelanggan.layouts.abouts', [
            'profilToko' => $profilToko
        ]);
    }

    public function statusservis() // melihat status servis
    {
       $antrian = Antrian::with('user', 'konsol')->get();
       return view('dashboardpelanggan.status_servis.viewstatus_servis', [
           'antrian' => $antrian
       ]);
    }
}
