<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendala extends Model
{
    protected $table = 'tbl_kendala';
    protected $primaryKey = 'id_kerusakan';
    protected $fillable = ['id_konsol', 'kendala_kerusakan'];
    use HasFactory;

    public function konsol()
    {
        return $this->belongsTo(Konsol::class, 'id_konsol');
    }
}
