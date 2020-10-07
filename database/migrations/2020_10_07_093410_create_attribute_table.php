<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute', function (Blueprint $table) {
            $table->integer('Id_Order_Detail')->unsigned();
            $table->integer('Sugar')->unsigned();
            $table->integer('Ice')->unsigned();
            $table->string('Hot');
            $table->timestamps();
        });

        Schema::table('attribute', function (Blueprint $table) {
            $table->primary('Id_Order_Detail');
            $table->foreign('Id_Order_Detail')->references('Id')->on('order_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute');
    }
}
