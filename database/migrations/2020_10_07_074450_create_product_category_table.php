<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->integer('Id_Category')->unsigned();
            $table->integer('Id_Product')->unsigned();
            $table->timestamps();
        });

        Schema::table('product_category', function (Blueprint $table) {
            $table->primary('Id_Category', 'Id_Product');
            $table->foreign('Id_Category')->references('Id')->on('category');
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
        Schema::dropIfExists('product_category');
    }
}
