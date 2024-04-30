<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilToko extends Model
{
    protected $table = 'tbl_profil_toko';
    protected $primaryKey = 'id_toko';
    protected $fillable = ['id_pelanggan','id_teknisi','nama_toko', 'deskripsi', 'foto'];
    use HasFactory;

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class, "id_teknisi");
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, "id_pelanggan");
    }
}
