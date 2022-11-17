<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleOrdenComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_orden_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_compra');
            $table->foreign('orden_compra')->references('id')->on('orden_compras');
            $table->foreignId('product_id')->constrained();
            $table->decimal('precio',10,2);
            $table->integer('cantidad');
      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_orden_compras');
    }
}
