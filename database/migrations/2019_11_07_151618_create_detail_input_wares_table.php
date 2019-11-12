<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailInputWaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_input_wares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('detail_input_quantity');
            $table->integer('detail_input_amount');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('inputWare_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('inputWare_id')->references('id')->on('input_wares')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_input_wares');
    }
}
