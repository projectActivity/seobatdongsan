<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Banner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenbanner', 250);
            $table->integer('vitri');
            $table->string('lienket', 250);
            $table->string('hinhanh', 500);
            $table->boolean('hienthi')->default(0);
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
        Schema::dropIfExists('Banner');
    }
}
