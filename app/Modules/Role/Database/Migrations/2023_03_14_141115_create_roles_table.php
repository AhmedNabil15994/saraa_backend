<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar')->required();
              $table->string('name_en')->required();
              $table->text('permissions')->nullable();
              $table->integer('status')->default(0);
              $table->integer('created_by')->nullable();
      
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
