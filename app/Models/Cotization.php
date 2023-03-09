<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotization extends Model
{
    use HasFactory;
    protected $fillable = ['total','items','observation','finaldate','status','cliente_id','user_id','sucursal_id'];
}
