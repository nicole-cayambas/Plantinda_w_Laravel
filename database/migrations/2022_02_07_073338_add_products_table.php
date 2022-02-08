<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('summary');
            $table->string('description');
            $table->string('image');
            $table->integer('rating');
            $table->integer('category_id');
            $table->double('unit_price_1');
            $table->double('unit_price_2');
            $table->double('unit_price_3');
            $table->double('unit_price_4');
            $table->integer('range_1_min');
            $table->integer('range_1_max');
            $table->integer('range_2_min');
            $table->integer('range_2_max');
            $table->integer('range_3_min');
            $table->integer('range_3_max');
            $table->integer('range_4_min');
            $table->integer('range_4_max');
            $table->integer('store_id');
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
