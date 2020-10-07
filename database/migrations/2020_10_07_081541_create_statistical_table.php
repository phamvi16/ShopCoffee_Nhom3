<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistical', function (Blueprint $table) {
            $table->integer('Id_Product')->unsigned();
            $table->integer('Purchase')->unsigned();
            $table->timestamps();
        });

        Schema::table('statistical', function (Blueprint $table) {
            $table->primary('Id_Product');
            $table->foreign('Id_Product')->references('Id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistical');
    }
}
