<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('codice_prodotto');
            $table->string('codice_stock');
            $table->string('settore');
            $table->string('scaffale');
            $table->integer('quantita_rimanente');
            $table->integer('quantita_di_cartoni');
            $table->integer('quantita_a_cartone');
            $table->integer('quantita_bloccata');
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
        Schema::dropIfExists('sectors');
    }
}
