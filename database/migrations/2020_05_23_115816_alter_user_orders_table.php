<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voidcodigo_rastreio
     */
    public function up()
    {
        Schema::table('user_orders', function (Blueprint $table) {
            $table->string('pedido_status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_orders', function (Blueprint $table) {
            $table->dropColumn('pedido_status');
        });
    }
}
