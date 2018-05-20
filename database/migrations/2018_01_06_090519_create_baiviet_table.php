<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaivietTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BaiViet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chudeid');
            $table->string('tenbaiviet', 250);
            $table->text('description');
            $table->string('keyword', 500);
            $table->boolean('hienthi')->default(0);
            $table->string('hinhanh', 500);
            $table->text('tomtat');
            $table->text('noidung');
            $table->boolean('ghim')->default(0);
            $table->string('slug', 250);
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
        Schema::dropIfExists('BaiViet');
    }
}
