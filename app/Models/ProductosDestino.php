<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosDestino extends Model
{
    use HasFactory;

    protected $fillable=['product_id','destino_id','stock'];

    
    public function productos(){
      return $this->belongsTo(Product::class,'productos_destinos.product_id','id');  
    }
    public function destinos(){
      return $this->belongsTo(Destino::class,'destino_id','id');  
    }

    public function ingresoproductos()
    {
        return $this->hasMany(IngresoProductos::class,'destino');
    }
    public function mobiliario(){
        return $this->hasMany(LocationProducto::class,'product_id','product');
    }
}
