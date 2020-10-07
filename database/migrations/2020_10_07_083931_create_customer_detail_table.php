<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_detail', function (Blueprint $table) {
            $table->bigInteger('Phone')->unsigned();
            $table->string('Name');
            $table->date('Birthday');
            $table->string('Email');
            $table->timestamps();
        });

        Schema::table('customer_detail', function (Blueprint $table) {
            $table->primary('Phone');
            $table->foreign('Phone')->references('Phone')->on('customer_account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_detail');
    }
}
