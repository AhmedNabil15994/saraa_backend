<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearsTable extends Migration
{
    public function up()
    {
        Schema::create('years', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->required();
          
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('years');
    }
}
