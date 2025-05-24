<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password')->required();
            $table->string('remember_token')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->unique();
            $table->string('calling_code')->nullable();
            $table->text('extra_permissions')->nullable();
            $table->integer('role_id')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(0);
            $table->integer('is_verified')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
