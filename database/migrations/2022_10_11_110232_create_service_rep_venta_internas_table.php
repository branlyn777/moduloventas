<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRepVentaInternasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Se necesita el costo del lote para determinar la utiliadad, lo cual podria fallar si tenemos varias solicitudes del mismo producto en un mismo servicio y que estos proavengan de diferentes lotes, en todo caso
        
        Schema::create('service_rep_venta_internas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('cantidad');
            $table->decimal('precio_venta',10,2);
            $table->string('lote',100)->nullable();
  
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
        Schema::dropIfExists('service_rep_venta_internas');
    }
}
