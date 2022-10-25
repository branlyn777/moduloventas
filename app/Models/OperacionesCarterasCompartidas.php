<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperacionesCarterasCompartidas extends Model
{
    use HasFactory;
    protected $fillable = ['caja_id','cartera_compartida_id'];


}
