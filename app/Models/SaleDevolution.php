<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDevolution extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','amount','description','utility','status','user_id','destino_id','sale_detail_id','sucursal_id'];
}