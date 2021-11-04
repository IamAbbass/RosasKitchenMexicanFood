<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default("image.png");
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->longText('address');
            $table->string('ntn')->nullable();
            $table->string('strn')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
