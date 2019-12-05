<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductQualityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_quality', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->integer('product_price')->nullable();
            $table->unsignedBigInteger('quality_id');
            $table->foreign('quality_id')->references('id')->on('qualities')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_quality');
    }
}
