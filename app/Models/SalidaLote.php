<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaLote extends Model
{
    use HasFactory;
    protected $fillable = ['salida_detalle_id', 'lote_id', 'cantidad'];
}
