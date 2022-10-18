<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'adress', 'telefono', 'celular', 'nit_id', 'company_id'];

    public function cajas()
    {
        return $this->hasMany(Caja::class);
    }
    public function usuarios()
    {
        return $this->hasMany(SucursalUser::class);
    }
}
