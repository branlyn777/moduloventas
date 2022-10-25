<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperacionesCarterasCompartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones_carteras_compartidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('caja_id');
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->unsignedBigInteger('cartera_compartida_id');
            $table->foreign('cartera_compartida_id')->references('id')->on('carteras');
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('operaciones_carteras_compartidas');
    }
}
