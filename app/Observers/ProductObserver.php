<?php

namespace App\Observers;

use App\Models\ProductosDestino;

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
        $stockTotal=ProductosDestino::where('product_id',$productosDestino->id)->sum('stock');
        dd($productosDestino);
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
