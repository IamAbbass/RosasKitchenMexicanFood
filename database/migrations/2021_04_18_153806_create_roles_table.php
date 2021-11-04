<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->enum('permission',  ['Owner', 'Admin', 'Manager', 'User'])->default('User');
            $table->string('title')->default('Limited Access');
            $table->boolean('index')->default(true);
            $table->boolean('create')->default(false);
            $table->boolean('store')->default(false);
            $table->boolean('show')->default(false);
            $table->boolean('edit')->default(false);
            $table->boolean('update')->default(false);
            $table->boolean('destroy')->default(false);
            $table->boolean('is_available')->default(false);  
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
        Schema::dropIfExists('roles');
    }
}
