<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('codice_prodotto');
            $table->string('codice_stock');
            $table->date('data_di_scadenza');
            $table->string('lotto');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('prezzo_al_pezzo', 10, 2);
            $table->decimal('prezzo_al_kg', 10, 2);
            $table->decimal('peso', 10, 3);
            $table->boolean('esaurito')->default(0);
            $table->foreignId('category_id')->constrained();
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
