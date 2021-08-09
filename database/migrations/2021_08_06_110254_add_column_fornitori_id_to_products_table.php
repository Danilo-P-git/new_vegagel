<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFornitoriIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            
                $table->unsignedBigInteger('fornitori_id')->after('photo');
                $table->foreign('fornitori_id')->references('id')->on('fornitoris');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('[fornitori_id]');
            $table->dropColumn('fornitori_id');
        });
    }
}
