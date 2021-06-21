<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            // $table->date('date_of_birth')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pec')->nullable();
            $table->string('telefono')->nullable();
            $table->string('indirizzo')->nullable();
            $table->string('codice_fiscale')->nullable();
            $table->string('citta')->nullable();
            $table->string('cap')->nullable();
            $table->string('comune')->nullable();
            $table->string('provincia')->nullable();
            $table->string('partita_iva')->nullable();
            $table->string('ragione_sociale')->nullable();
            $table->string('num_documento')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->boolean('is_worker')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
