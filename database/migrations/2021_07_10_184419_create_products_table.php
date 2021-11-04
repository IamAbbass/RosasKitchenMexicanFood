<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->string('sku')->unique();
            $table->string('image')->default("default.png");
            $table->string('name')->unique();
            $table->string('name_ur')->nullable();
            $table->string('name_ru')->nullable();
            $table->enum('type',  ['China'])->nullable();
            $table->integer('category_id');
            $table->integer('unit_id');
            $table->integer('supplier_id');
            $table->integer('badge_id')->nullable();
            $table->integer('account_id');
            $table->integer('purchase');
            $table->integer('purchased_qty');
            $table->integer('purchased_unit');
            $table->integer('sale');
            $table->integer('discount')->default(0);
            $table->string('dated');
            $table->longText('description')->nullable();
            $table->longText('note')->nullable();
            $table->boolean('is_highlight')->default(false);
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
        Schema::dropIfExists('products');
    }
}
