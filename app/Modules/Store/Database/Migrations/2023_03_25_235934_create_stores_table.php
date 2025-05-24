<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar')->required();
            $table->string('title_en')->required();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->integer('seller_id')->required();
            $table->string('image')->nullable();
            $table->string('off_days')->nullable();
            $table->string('work_from')->nullable();
            $table->string('work_to')->nullable();
            $table->integer('state_id')->required();
            $table->text('address_ar')->nullable();
            $table->text('address_en')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->longText('contact_info')->nullable();
          


            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
