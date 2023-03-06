<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotization_details', function (Blueprint $table) {
            $table->id();
            $table->decimal('price',10,2);
            $table->integer('quantity');
            $table->foreignId('product_id')->constrained();
            $table->foreignId('cotization_id')->constrained();
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
        Schema::dropIfExists('cotization_details');
    }
}