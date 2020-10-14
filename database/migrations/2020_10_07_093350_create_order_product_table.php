<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Id_Product_Size')->unsigned();
            $table->integer('Id_Order')->unsigned();
            $table->integer('Price_Buy')->unsigned();
            $table->timestamps();
        });

        Schema::table('order_product', function (Blueprint $table) {
            $table->foreign('Id_Product_Size')->references('Id')->on('product_size');
            $table->foreign('Id_Order')->references('Id')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
