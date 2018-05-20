<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGhimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ghim', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('baivietid');
            $table->string('url', 500);
            $table->boolean('trangthai')->default(0);
            $table->string('tenbaighim', 500);
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
        Schema::dropIfExists('Ghim');
    }
}
