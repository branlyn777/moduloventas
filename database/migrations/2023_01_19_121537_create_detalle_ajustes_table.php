<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleAjustesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ajustes', function (Blueprint $table) {
            $table->id();
     
            $table->foreignId('product_id')->constrained();
            $table->integer('recuentofisico');
            $table->integer('diferencia');
            $table->enum('tipo',['positiva','negativa']);
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
        Schema::dropIfExists('detalle_ajustes');
    }
}
