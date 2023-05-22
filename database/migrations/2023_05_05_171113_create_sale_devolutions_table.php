<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDevolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_devolutions', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->decimal('amount', 8, 2)->default(0.00);
            $table->text('description');
            $table->decimal('utility', 8, 2)->default(0.00);
            $table->enum('status',['active','inactive'])->default('active');
            $table->integer('walletid')->default(0);
            $table->integer('motionid')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('destino_id')->constrained();
            $table->foreignId('sale_detail_id')->constrained();
            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
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
        Schema::dropIfExists('sale_devolutions');
    }
}
