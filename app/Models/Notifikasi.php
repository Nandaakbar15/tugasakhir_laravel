<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'tbl_notifikasi';
    protected $primaryKey = "id_notifikasi";
    protected $fillable = ['id_pelanggan','id_teknisi','isi_notifikasi'];
    use HasFactory;

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, "id_pelanggan");
    }

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class, "id_teknisi");
    }
}
