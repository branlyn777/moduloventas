<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizationDetail extends Model
{
    use HasFactory;
    protected $fillable = ['price','quantity','product_id','cotization_id'];
}
