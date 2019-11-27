<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputWaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_wares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('input_code')->nullable();
            $table->string('input_content')->nullable();
            $table->timestamp('input_date')->nullable();
            $table->integer('input_total_money')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_wares');
    }
}
