<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaoBangChude extends Migration
{
    public function up()
    {
        Schema::create('ChuDe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenchude')->unique();
            $table->boolean('duan')->default(0);
            $table->boolean('noibat')->default(0);
            $table->boolean('trongtam')->default(0);
            $table->text('tomtat');
            $table->text('hinhanh');
            $table->string('tenthuongmai', 500);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ChuDe');
    }
}
