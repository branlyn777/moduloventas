<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrdenCompra extends Model
{
    use HasFactory;
    protected $fillable = ['orden_compra','product_id','precio','cantidad'];

    public function ordencompra(){
        return $this->belongsTo(OrdenCompra::class);
    }

    public function productos()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
