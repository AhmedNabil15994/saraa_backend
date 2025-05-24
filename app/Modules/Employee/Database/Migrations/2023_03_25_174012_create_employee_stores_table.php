<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeStoresTable extends Migration
{
    public function up()
    {
        Schema::create('employee_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('emp_id')->required();
            $table->integer('store_id')->required();          
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_stores');
    }
}
