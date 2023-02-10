<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionDetalle extends Model
{
    use HasFactory;
    protected $fillable = ['products_id', 'precio', 'cantidad', 'cotizacion_id'];
}
