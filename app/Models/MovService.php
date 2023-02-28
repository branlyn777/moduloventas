<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovService extends Model
{
    use HasFactory;

    protected $fillable = ['movimiento_id','service_id'];

    public function movs()
    {
        return $this->belongsTo(Movimiento::class,'movimiento_id','id');
    }
}
