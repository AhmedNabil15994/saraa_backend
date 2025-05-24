<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar')->required();
            $table->string('title_en')->required();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->integer('store_id')->required();
            $table->string('color')->nullable();
            $table->string('type')->nullable();
            $table->integer('brand_id')->required();
            $table->integer('model_id')->required();
            $table->string('year')->nullable();
            $table->json('prices')->required();
            $table->string('available_from')->nullable();
            $table->string('available_to')->nullable();
            $table->string('image')->nullable();
            $table->text('attachments')->nullable();
            $table->integer('is_monthly')->default(0);
            $table->integer('is_daily')->default(0);
          
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
