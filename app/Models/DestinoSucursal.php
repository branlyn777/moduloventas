<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinoSucursal extends Model
{
    use HasFactory;
    protected $fillable = ['destino_id','sucursal_id'];
}