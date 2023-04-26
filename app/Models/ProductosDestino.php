<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosDestino extends Model
{
    use HasFactory;

    protected $fillable=['product_id','destino_id','stock'];

    
    public function productos(){
       $this->belongsTo(Product::class,'productos_destinos.product_id','id');  
    }
    public function destinos(){
       $this->belongsTo(Destino::class,'productos_destinos.destino_id','id');  
    }

    public function ingresoproductos()
    {
        return $this->hasMany(IngresoProductos::class,'destino');
    }
}
