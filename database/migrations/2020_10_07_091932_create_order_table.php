<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Customer')->unsigned();
            $table->integer('Coupon')->unsigned();
            $table->integer('Payment_Method')->unsigned();
            $table->integer('Total_Quantity')->unsigned();
            $table->float('Total');
            $table->integer('Point');
            $table->string('Status');
            $table->timestamps();
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign('Customer')->references('Id')->on('customer_shipping');
            $table->foreign('Coupon')->references('Id')->on('coupon');
            $table->foreign('Payment_Method')->references('Id')->on('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
