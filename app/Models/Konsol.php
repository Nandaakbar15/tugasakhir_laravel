<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsol extends Model
{
    protected $table = 'tbl_konsol';
    protected $primaryKey = 'id_konsol';
    protected $fillable = ['id_pelanggan', 'nama_konsol', 'foto'];
    use HasFactory;

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function kendala()
    {
        return $this->hasMany(Kendala::class, 'id_kerusakan');
    }
}
