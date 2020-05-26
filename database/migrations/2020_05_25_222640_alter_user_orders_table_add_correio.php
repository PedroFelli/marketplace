<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserOrdersTableAddCorreio extends Migration
{
    public function up()
    {
        Schema::table('user_orders', function (Blueprint $table
        ) {
            $table->string('codigo_rastreio')->nullable();
            $table->boolean('send_cod_rastreio')->nullable();
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
            $table->dropColumn('codigo_rastreio');
            $table->dropColumn('send_cod_rastreio');
        });
    }
}
