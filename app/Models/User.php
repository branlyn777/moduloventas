<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'profile',
        'status',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImagenAttribute()
    {
        if ($this->image == null) {
            return 'noimagen.png';
        }
        if (file_exists('storage/usuarios/' . $this->image))
            return $this->image;
        else {
            return 'noimagen.png';
        }
    }

    public function sucursalusers()
    {
        return $this->hasMany(SucursalUser::class);
    }
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
    public function ventas()
    {
        return $this->hasMany(Sale::class);
    }
    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
    public function transferencia()
    {
        return $this->hasMany(EstadoTransferencia::class,'id_usuario','id');
    }
}
