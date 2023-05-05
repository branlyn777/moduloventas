<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDevolution extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','amount','description','status','destino_id','sale_detail_id'];
}
