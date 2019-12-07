<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutputWaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('output_wares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('output_code')->nullable();
            $table->string('output_content')->nullable();
            $table->timestamp('output_date')->nullable();
            $table->integer('output_total_money')->nullable();
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

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
        Schema::dropIfExists('output_wares');
    }
}
