<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;


    protected $fillable = ['nombre','costo','caracteristicas','codigo','lote',
    'unidad','marca','garantia','cantidad_minima','industria','precio_venta','status','image', 'category_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
  
 
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function destinos()
    {
        return $this->belongsToMany(Destino::class,'productos_destinos','product_id','destino_id');
    }
    public function detalleCompra()
    {
        return $this->hasMany(CompraDetalle::class,'product_id','id');
    }
    public function detalleSalida()
    {
        return $this->hasMany(DetalleSalidaProductos::class,'product_id','id');
    }
    public function detalleEntrada()
    {
        return $this->hasMany(DetalleEntradaProductos::class,'product_id','id');
    }
    
    public function detalleTransferencia()
    {
        return $this->hasMany(DetalleTransferencia::class,'product_id','id');
    }
    
    public function detalleVenta()
    {
        return $this->hasMany(SaleDetail::class,'product_id','id');
    }
    public function location()
    {
        return $this->belongsToMany(Location::class,'location_productos','product','id');
        
    }

    public function codigo($id){
        $mn=Product::find($id)->codigo;
        return $mn;
    }

    public function precioActivo(){
        $var=Lote::where('status','Activo')->where('product_id',$this->id)->get();
        foreach ($var as $value) {
            return $value->pv_lote;
        }
    }
    public function costoActivo(){
        $var=Lote::where('status','Activo')->where('product_id',$this->id)->get();
        foreach ($var as $value) {
            return $value->costo;
        }
    }
    




    public function getImagenAttribute()
    {
        if ($this->image == null)
        {
           return 'noimagenproduct.png';
        }
        if (file_exists('storage/productos/'. $this->image))
            return $this->image;
        else 
        {
            return 'noimagenproduct.png';
        }
    }

 


}
