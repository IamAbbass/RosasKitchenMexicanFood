<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');

            //Devide info
            $table->string('brand')->nullable();            
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('os')->nullable();
            $table->string('imei')->nullable();
            $table->string('android_id')->nullable();              
            $table->longText('fcm_token')->nullable();
            //Google Auth
            $table->longText('image')->nullable();
            $table->string('uuid')->nullable();
            //Facebook
            $table->string('psid')->nullable();
            $table->string('fb_profile_name')->nullable();  
            //Locality
            $table->integer('region_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('township_id')->nullable();
            $table->integer('town_id')->nullable();
            //Security
            $table->longText('device_token')->nullable(); 

            $table->boolean('is_available')->default(true);
            $table->string('record_by')->default("0");
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
        Schema::dropIfExists('customers');
    }
}
