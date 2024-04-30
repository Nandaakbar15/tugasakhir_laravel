<?php

namespace App\Exports;

use App\Models\Pelanggan;
use App\Models\Antrian;
use Maatwebsite\Excel\Concerns\FromCollection;

class laporanServis implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pelanggan::all();
    }
}
