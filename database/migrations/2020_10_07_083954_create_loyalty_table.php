<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty', function (Blueprint $table) {
            $table->string('Phone');
            $table->string('Level');
            $table->integer('Point');
            $table->integer('Discount_Loyalty');
            $table->timestamps();
        });

        Schema::table('loyalty', function (Blueprint $table) {
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
        Schema::dropIfExists('loyalty');
    }
}
