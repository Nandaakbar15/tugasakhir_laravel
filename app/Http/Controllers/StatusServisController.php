<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\ServiceStatusUpdated;

class StatusServisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = Auth::user()->name;
        $antrian = Antrian::all();
        $antrian = Antrian::with('konsol')->get();
        return view('dashboard.statusservis.viewstatusservis', [
            'antrian' => $antrian,
            'username' => $username
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Antrian $antrian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antrian $antrian)
    {
        $username = Auth::user()->name;
        return view('dashboard.statusservis.ubahstatus', [
            'antrian' => $antrian,
            'username' => $username
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antrian $antrian)
    {
        $validate = $request->validate([
            'status_servis' => 'required'
        ]);

        $antrian->update([
            'status_servis' => $validate['status_servis']
        ]);

        event(new ServiceStatusUpdated($antrian));

        return redirect('/dashboard')->with('success', 'Status Servis Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antrian $antrian)
    {
        //
    }
}
