<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->bigInteger('payment_id');
            $table->string('order_status', 10);
            $table->dateTime('date_order_placed');
            $table->dateTime('date_order_paid');
            $table->double('production_cost', 15, 2);
            $table->double('total_price', 15, 2);
            $table->double('total_discount', 15, 2);
            $table->double('total_payment', 15, 2);
            $table->string('other_order_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
