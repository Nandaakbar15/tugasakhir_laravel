<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Antrian extends Model
{
    protected $table = 'tbl_antrian';
    protected $primaryKey = 'id_antrian';
    protected $fillable = ['id_konsol', 'id_pelanggan', 'nama_pelanggan', 'email', 'no_antrian', 'tgl_servis', 'status_servis'];
    use HasFactory;

   protected static function boot()
    {
        parent::boot();

        static::creating(function ($antrian) {
            // Logic to generate no_antrian (incrementing from the last record)
            $lastAntrian = static::latest()->first();
            $antrian->no_antrian = $lastAntrian ? $lastAntrian->no_antrian + 1 : 1;
            $antrian->tgl_servis = now();
        });
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function konsol()
    {
        return $this->belongsTo(Konsol::class, 'id_konsol');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pelanggan');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, "id_pembayaran");
    }

    public function scopeFilter($query)
    {
        if(request('cari_laporan')) {
            $query->where('no_antrian', 'like', '%' . request('cari_laporan') . '%')
                  ->orWhere('tgl_servis', 'like', '%' . request('cari_laporan') . '%');
        }

        return $query;
    }
}
