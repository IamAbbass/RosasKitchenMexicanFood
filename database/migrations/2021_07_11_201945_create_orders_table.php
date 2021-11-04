<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->integer('order_status_id');
            $table->integer('customer_id');
            $table->string('order_no');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->string('location')->nullable(); //mobile
            $table->string('coupon')->nullable();
            $table->enum('payment_method',  ['COD', 'Debit Card', 'Credit Card'])->default("COD");
            $table->enum('payment_status',  ['Paid', 'Unpaid'])->default("Unpaid");
            $table->integer('delivery_id')->nullable();
            $table->longText('note')->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('rider_id')->nullable();
            $table->string('dated');
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
        Schema::dropIfExists('orders');
    }
}
