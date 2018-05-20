<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockcontentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BlockContent', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chudeid');
            $table->integer('loaiblockid');
            $table->boolean('hienthi')->default(0);
            $table->string('tenblock', 250);
            $table->text('tomtat');
            $table->string('subtitle', 250);
            $table->text('noidung');
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
        Schema::dropIfExists('BlockContent');
    }
}
