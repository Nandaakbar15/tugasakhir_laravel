<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table = 'tbl_teknisi';
    protected $primaryKey = "id_teknisi";
    protected $fillable = ['nama_teknisi', 'alamat', 'no_telp'];
    use HasFactory;

    public function notifikasi()
    {
        return $this->belongsTo(Notifikasi::class, "id_notifikasi");
    }

    public function profilToko()
    {
        return $this->belongsTo(ProfilToko::class, "id_toko");
    }

    public function scopeFilter($query)
    {
        if(request('cari_user')) {
            $query->where('nama_teknisi', 'like', '%' . request('cari_user') . '%');
        }

        return $query;
    }
}
