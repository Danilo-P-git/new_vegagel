<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEcommerceToOrderEcommerces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_ecommerces', function (Blueprint $table) {
            $table->integer('ecommerce')->after('data_di_consegna')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_ecommerces', function (Blueprint $table) {
            $table->dropColumn('ecommerce');
        });
    }
}
