<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Id_Product')->unsigned();
            $table->integer('Id_Order')->unsigned();
            $table->integer('Price_Buy')->unsigned();
            $table->timestamps();
        });

        Schema::table('order_detail', function (Blueprint $table) {
            $table->foreign('Id_Product')->references('Id')->on('product');
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
        Schema::dropIfExists('order_detail');
    }
}
