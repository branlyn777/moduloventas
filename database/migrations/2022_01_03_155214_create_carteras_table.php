<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarterasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->decimal('saldocartera',10,2)->default(0);
            $table->string('descripcion', 255)->nullable();
            $table->enum('tipo', ['efectivo','digital','Telefono','Sistema'])->default('efectivo');
            $table->enum('estado', ['ACTIVO','INACTIVO'])->default('ACTIVO');
            $table->integer('telefonoNum')->nullable();
            $table->unsignedBigInteger('caja_id');
            $table->foreign('caja_id')->references('id')->on('cajas');
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
        Schema::dropIfExists('carteras');
    }
}
