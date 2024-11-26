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
            $table->string('currency');
            $table->float('net_price');
            $table->string('discount_code');
            $table->float('discount');
            $table->float('shipping');
            $table->float('total');
            $table->string('order_number');
            $table->string('expected_delivery');
            $table->integer('status');
            $table->longtext('shipping_address');
            $table->longtext('billing_address');
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
