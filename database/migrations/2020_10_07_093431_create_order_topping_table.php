<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderToppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_topping', function (Blueprint $table) {
            $table->integer('Id_Order_Product')->unsigned();
            $table->integer('Id_Topping')->unsigned();
            $table->integer('Price_Buy')->unsigned();
            $table->timestamps();
        });

        Schema::table('order_topping', function (Blueprint $table) {
            $table->primary(['Id_Order_Product', 'Id_Topping']);
            $table->foreign('Id_Order_Product')->references('Id')->on('order_product');
            $table->foreign('Id_Topping')->references('Id')->on('topping');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_topping');
    }
}
