<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeProductTable extends Migration
{

    public function up()
    {
        Schema::create('product_size', function (Blueprint $table) {
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('size_product');
    }
}
