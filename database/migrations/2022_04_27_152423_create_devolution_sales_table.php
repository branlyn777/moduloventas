<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevolutionSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolution_sales', function (Blueprint $table) {
            $table->id();  
            $table->string('observations',200)->default('Sin Observacion')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('sale_detail_id')->constrained();
            $table->foreignId('sucursal_id')->constrained();
            $table->foreignId('movimiento_id')->constrained();
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
        Schema::dropIfExists('devolution_sales');
    }
}
