<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTable extends Migration
{
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar')->required();
          $table->string('title_en')->required();
          $table->string('color')->required();
          
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colors');
    }
}
