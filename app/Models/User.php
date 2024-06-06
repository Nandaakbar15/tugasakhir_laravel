<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Pelanggan;
use App\Model\Pembayaran;
use App\Models\Game_request;
use App\Models\Pembayaran as ModelsPembayaran;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'id_pelanggan');
    }

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'id_pelanggan');
    }

    public function teknisi()
    {
        return $this->hasMany(Teknisi::class, 'id_teknisi');
    }

    public function pembayaran()
    {
        return $this->hasMany(ModelsPembayaran::class, 'id_pelanggan');
    }

    public function gameList(): BelongsToMany
    {
        return $this->belongsToMany(Game_request::class, 'game_request_user', 'id_user', 'id_game_request');
    }
}
