<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->integer('customer_id');
            $table->string('api_token');
            $table->string('image')->default("default.png");
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_verified')->default(false);            
            $table->string('password')->nullable();
            $table->longText('address')->nullable();
            $table->integer('wallet')->default("0");
            $table->integer('role_id')->default("2");
            $table->boolean('is_available')->default(false);
            $table->string('record_by')->default("0");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
