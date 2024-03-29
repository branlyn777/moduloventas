<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAjustes extends Model
{
    use HasFactory;
    
    protected $fillable = ['product_id','recuentofisico','diferencia','tipo','id_ajuste'];

    public function productos()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}