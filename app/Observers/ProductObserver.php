<?php

namespace App\Observers;

use App\Listeners\EnviarUsuarioStockMinimoNotification;
use App\Models\Destino;
use App\Models\ProductosDestino;
use App\Models\User;
use App\Notifications\StockNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ProductObserver
{
    /**
     * Handle the ProductosDestino "created" event.
     *
     * @param  \App\Models\ProductosDestino  $productosDestino
     * @return void
     */
    public function created(ProductosDestino $productosDestino)
    {
        //
    }

    /**
     * Handle the ProductosDestino "updated" event.
     *
     * @param  \App\Models\ProductosDestino  $productosDestino
     * @return void
     */
    public function updated(ProductosDestino $productosDestino)
    {
        $stockTotal=ProductosDestino::where('product_id',$productosDestino->product_id)->where('destino_id',$productosDestino->destino_id)->sum('stock');
       $perm_destinos=Destino::where('id',$productosDestino->destino_id)->pluck('codigo_almacen');

        $users=User::permission($perm_destinos)->get(); 

         if ($stockTotal<1) {

            //$admin = User::where('role', 1)->first();


            Notification::send($users, new StockNotification($productosDestino->id));

       }
    }

    /**
     * Handle the ProductosDestino "deleted" event.
     *
     * @param  \App\Models\ProductosDestino  $productosDestino
     * @return void
     */
    public function deleted(ProductosDestino $productosDestino)
    {
        //
    }

    /**
     * Handle the ProductosDestino "restored" event.
     *
     * @param  \App\Models\ProductosDestino  $productosDestino
     * @return void
     */
    public function restored(ProductosDestino $productosDestino)
    {
        //
    }

    /**
     * Handle the ProductosDestino "force deleted" event.
     *
     * @param  \App\Models\ProductosDestino  $productosDestino
     * @return void
     */
    public function forceDeleted(ProductosDestino $productosDestino)
    {
        //
    }
}
