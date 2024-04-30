<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'tbl_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $fillable = ["id_pelanggan", "id_antrian", "jumlah_pembayaran", "tgl_pembayaran", "status"];

    public function pelanggan()
    {
        return $this->hasMany(Pelanggan::class, "id_pelanggan");
    }

    public function antrian()
    {
        return $this->hasMany(Antrian::class, "id_antrian");
    }
}
