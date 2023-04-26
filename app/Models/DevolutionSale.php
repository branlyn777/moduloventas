<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevolutionSale extends Model
{
    use HasFactory;
    protected $fillable = ['observations','status','user_id','sale_detail_id','sucursal_id'];
}
