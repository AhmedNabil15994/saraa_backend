<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar')->required();
            $table->string('title_en')->required();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(0);
          
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
