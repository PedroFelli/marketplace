<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorTable extends Migration
{
    public function up()
    {
        Schema::create('color_product', function (Blueprint $table) {
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
    public function down()
    {
        Schema::dropIfExists('color_product');
    }
}
