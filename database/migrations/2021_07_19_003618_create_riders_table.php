<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->string('image')->default("default.png");
            $table->string('name');
            $table->string('cnic')->unique();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->longText('address');
            $table->boolean('is_available')->default(true);
            $table->string('record_by');
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
        Schema::dropIfExists('riders');
    }
}
