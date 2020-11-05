<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->string('Id');
            $table->string('Type');
            $table->float('Value');
            $table->longText('Description');
            $table->dateTime('Started_at');
            $table->dateTime('Ended_at');
            $table->timestamps();
        });

        Schema::table('coupon', function (Blueprint $table) {
            $table->primary('Id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon');
    }
}
