<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id')->required();
            $table->integer('car_id')->required();
            $table->integer('client_id')->required();
            $table->dateTime('reserve_from')->required();
            $table->dateTime('reserve_to')->required();
            $table->double('price')->required();
            $table->integer('coupon_id')->nullable();
            $table->double('discount_price')->nullable();
            $table->text('files')->nullable();
            $table->string('lat')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('lng')->nullable();
            $table->longText('notes')->nullable();

            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
