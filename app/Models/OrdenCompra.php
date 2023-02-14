<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    use HasFactory;
    protected $fillable = ['importe_total','observacion','proveedor_id','status','destino_id','user_id','estado_entrega'];
    public function detallecompra(){
        return $this->hasMany(DetalleOrdenCompra::class,'orden_compra','id');
    }

    public function proveedor(){
        return $this->belongsTo(Provider::class);
    }
    public function destino(){
        return $this->belongsTo(Destino::class);
    }
    public function usuario(){
        return $this->belongsTo(User::class,'user_id','id');
    }
   
    public function compra()
    {
        return $this->hasMany(OrdenCompraAsignada::class,'orden_compra','id');
    }
}
