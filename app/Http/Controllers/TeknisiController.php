<?php

namespace App\Http\Controllers;

use App\Exports\laporanServis;
use App\Models\Teknisi;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Konsol;
use App\Models\Antrian;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\SendMessageTechinian;
use Illuminate\Support\Facades\Notification;

class TeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // halaman dashboard untuk admin/teknisi
    {
        $username = Auth::user()->name;
        return view('dashboard.layouts.home', ['username' => $username]); // view untuk admin / teknisi
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // view data teknisi
    {
        $username = Auth::user()->name;
        return view('dashboard.datauser.tambahTeknisi', ['username' => $username]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // tambah teknisi
    {
        $validateData = $request->validate([
            'nama_teknisi' => 'required|max:50',
            'alamat' => 'required',
            'no_telp' => 'required|max:30',
        ]);

        Teknisi::create($validateData);

        return redirect('/dashboard')->with('success', 'Teknisi Berhasil di tambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teknisi $teknisi)
    {
        $username = Auth::user()->name;
        return view('dashboard.datauser.ubahDataTeknisi', [
            'teknisi' => $teknisi,
            'username' => $username
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teknisi $teknisi)
    {
        $validate = $request->validate([
            'nama_teknisi' => 'required|max:50',
            'alamat' => 'required',
            'no_telp' => 'required|max:30',
        ]);

        $teknisi->update($validate);
        Teknisi::where('id_teknisi', $teknisi->id_teknisi)
             ->update($validate);

        return redirect('/dashboard')->with('success', 'Data Teknisi berhasil di ubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teknisi $teknisi)
    {
        Teknisi::destroy('id_teknisi', $teknisi->id_teknisi);
        return redirect('/dashboard')->with('success', 'Data Teknisi Berhasil di hapus!');
    }

    public function datalaporan_servis() // view data laporan servis
    {
        $username = Auth::user()->name;
        $pelanggan = Pelanggan::all();
        $currentDate = Carbon::now()->toDateString();
        $antrian = Antrian::whereDate('tgl_servis', '=', $currentDate)->get();
        return view('dashboard.datalaporanservis.viewlaporanservis', [
            'pelanggan' => $pelanggan,
            'antrian' => $antrian,
            'username' => $username
        ]);
    }

    public function cari_laporan() // search laporan
    {
        $username = Auth::user()->name;
        $antrian = Antrian::latest()->filter()->get();
        return view('dashboard.datalaporanservis.viewlaporanservis', [
            'antrian' => $antrian,
            'username' => $username
        ]);
    }

    public function exportExcel() // Export data ke format Excel
    {
        return Excel::download(new laporanServis, 'laporan_servis.xlsx');
    }

    public function exportpdf() // Export data ke format PDF
    {
        $pelanggan = Pelanggan::all();
        $antrian = Antrian::latest()->filter()->get();
        $data = [
            'pelanggan' => $pelanggan,
            'antrian' => $antrian,
        ];

        $pdf = PDF::loadview('dashboard.datalaporanservis.laporanservis', $data);
        return $pdf->download('laporan_servis.pdf');
    }

    public function sendMessage() // view kirim pesan ke pelanggan
    {
        $pelanggan = Pelanggan::all();
        $username = Auth::user()->name;
        return view("dashboard.sendMessage.viewsendmessage", [
            "username" => $username,
            "pelanggan" => $pelanggan
        ]);
    }

    public function sendNotification(Request $request) // logika kirim pesan ke pelanggan
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        if($pelanggan) {
            $notificationdetails = [
                'greeting' => 'Dear customer yang bernama, ' . $pelanggan->nama_pelanggan,
                'body' => $request->message,
                'thanks' => 'Terimakasih sudah menggunakan layanan kami!',
            ];

            Notification::route('mail', $pelanggan->email)
                         ->notify(new SendMessageTechinian($notificationdetails));

            return redirect("/dashboard")->with("success", "Pesan terkirim kepada pelanggan!");
        } else {
            return redirect()->back()->with('error', 'Pelanggan dengan email tersebut tidak ada!');
        }
    }


}
