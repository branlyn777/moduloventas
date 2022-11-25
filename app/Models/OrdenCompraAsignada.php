<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompraAsignada extends Model
{
    use HasFactory;
    protected $fillable = ['orden_compra','compra_id'];

}
