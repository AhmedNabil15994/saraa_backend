<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->required();
            $table->integer('discount_type')->required();
            $table->string('discount_value')->required();
            $table->string('valid_until')->required();
          
            $table->integer('valid_type')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
