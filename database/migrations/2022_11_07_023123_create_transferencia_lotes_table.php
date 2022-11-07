<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciaLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencia_lotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detalle_trans_id');
            $table->foreign('detalle_trans_id')->references('id')->on('detalle_transferencias');
            $table->unsignedBigInteger('lote_id');
            $table->foreign('lote_id')->references('id')->on('lotes');
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
        Schema::dropIfExists('transferencia_lotes');
    }
}
