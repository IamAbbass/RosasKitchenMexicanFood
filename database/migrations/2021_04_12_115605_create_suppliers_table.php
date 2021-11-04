<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('business_name');
            $table->string('phone');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
