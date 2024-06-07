<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Events\ServiceStatusUpdated;

class StatusServisApiController extends Controller
{
    public function index() // get all status servis
    {
        $antrian = Antrian::all();
        $antrian = Antrian::with('konsol')->get();
        $data = [
            'antrian' => $antrian
        ];
        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function update(Request $request, Antrian $antrian)
    {
        $validate = $request->validate([
            'status_servis' => 'required'
        ]);

        $antrian->update([
            'status_servis' => $validate['status_servis']
        ]);

        event(new ServiceStatusUpdated($antrian));

        return response()->json([
            'statusCode' => 200,
            'message' => 'Status Servis berhasil diubah!'
        ]);
    }
}
