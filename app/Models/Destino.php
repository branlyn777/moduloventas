<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Destino extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre','observacion','status','sucursal_id','codigo_almacen'];

    public function productos()
    {
        return $this->belongsToMany(Product::class,'productos_destinos','destino_id','product_id');
    }

 
    
    public function sucursals()
    {
        return $this->belongsTo(Sucursal::class,'sucursal_id','id');
    }
    public function dino()
    {
        return true;
    }


    public function ingresoproducto()
    {
        return $this->hasMany(IngresoProductos::class,'destino');
    }

    // public static function boot(){
    //     parent::boot();
    //     static::creating(function($model){
    //         $ms=Model::latest()->first();
    //         dd($ms);
            
    //         $model->codigo_almacen=$model->nombre.'-'.str_pad($model->id,5,0,STR_PAD_LEFT);
    //     });
    // }
    
    

}
