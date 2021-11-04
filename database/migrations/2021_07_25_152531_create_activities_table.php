<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('business_id')->nullable();
            $table->string('api_token')->nullable();
            $table->longText('uri')->nullable();
            $table->longText('method')->nullable();
            $table->longText('request_body')->nullable();
            $table->longText('response')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('acc')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
