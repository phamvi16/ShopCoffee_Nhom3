<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_shipping', function (Blueprint $table) {
            $table->increments('Id');
            $table->bigInteger('Phone')->unsigned();
            $table->integer('Id_Shipping')->unsigned();
            $table->timestamps();
        });

        Schema::table('customer_shipping', function (Blueprint $table) {
            $table->foreign('Phone')->references('Phone')->on('customer_account');
            $table->foreign('Id_Shipping')->references('Id')->on('shipping_information');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_shipping');
    }
}
