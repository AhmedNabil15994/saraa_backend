<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->json('address')->nullable();
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['address']);
        });
    }
}
