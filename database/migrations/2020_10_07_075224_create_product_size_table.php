<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_size', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Id_Product')->unsigned();
            $table->string('Size');
            $table->integer('Price');
            $table->integer('Sale_Price');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE  `product_size` DROP PRIMARY KEY , ADD PRIMARY KEY (  `Id` ,  `Id_Product` ,  `Size`  ) ;');

        Schema::table('product_size', function (Blueprint $table) {
            //$table->primary(['Id', 'Size', 'Id_Product']);
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
        //$table->dropPrimary('Id');
        Schema::dropIfExists('product_size');
    }
}
