<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game_request extends Model
{
    protected $table = 'tbl_game_request';
    protected $primaryKey = 'id_game';
    protected $fillable = ['id_pelanggan', 'nama_game', 'developer', 'tgl_rilis', 'platform', 'foto'];
    use HasFactory;

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
