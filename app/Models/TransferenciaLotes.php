<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenciaLotes extends Model
{
    use HasFactory;
    protected $fillable=['detalle_trans_id','lote_id','cantidad'];
}
