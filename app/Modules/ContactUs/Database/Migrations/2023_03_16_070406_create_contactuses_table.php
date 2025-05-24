<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactusesTable extends Migration
{
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->required();
          $table->string('email')->required();
          $table->string('phone')->required();
          $table->longText('message')->required();
          $table->integer('status')->default(0);
          
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
