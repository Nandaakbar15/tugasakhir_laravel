<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


use App\Models\Antrian;

class Pelanggan extends Model
{
    protected $table = 'tbl_pelanggan';
    protected $primaryKey = "id_pelanggan";
    protected $fillable = ['nama_pelanggan', 'alamat', 'no_telp', 'email'];
    use HasFactory, Notifiable;

    public function game_request()
    {
        return $this->hasMany(Game_request::class, "id_game");
    }

    public function konsol()
    {
        return $this->hasMany(Konsol::class, "id_konsol");
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, "id_notifikasi");
    }

    public function profilToko()
    {
        return $this->belongsTo(ProfilToko::class, "id_toko");
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, "id_pembayaran");
    }

    public function scopeFilter($query)
    {
        if(request('cari')) {
            $query->where('nama_pelanggan', 'like', '%' . request('cari') . '%');
        }

        return $query;
    }
}
