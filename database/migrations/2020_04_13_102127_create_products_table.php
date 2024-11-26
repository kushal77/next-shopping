<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('alias');
            $table->string('short_text');
            $table->string('description');
            $table->string('currency');
            $table->integer('cat_id')->default(0);
            $table->integer('brand_id')->default(0);
            $table->float('price');
            $table->integer('quantity')->default(0);
            $table->integer('status')->default(0);
            $table->integer('special_deals')->default(0);
            $table->integer('flash_sale')->default(0);
            $table->integer('top_sales')->default(0);
            $table->integer('most_liked')->default(0);
            $table->integer('just_for_you')->default(0);
            $table->integer('emi_available')->default(0);
            $table->longtext('seo');
            $table->longtext('custom')->nullable();
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
        Schema::dropIfExists('products');
    }
}
