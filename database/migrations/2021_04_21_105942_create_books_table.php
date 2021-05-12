<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('Copertina')->nullable();
            $table->string('Titolo')->nullable();
            $table->string('Autore')->nullable();
            $table->string('Serie')->nullable();
            $table->integer('Numero')->nullable();
            $table->string('Editore')->nullable();
            $table->string('Lingua')->nullable();
            $table->bigInteger('ISBN')->nullable();
            $table->float('Prezzo', 8, 2)->nullable();
            // $table->id();
            $table->string('MeseAnnoPubblicazione')->nullable();
            $table->boolean('Letto')->nullable();
            $table->string('DataLettura')->nullable();
            $table->boolean('Venduto')->nullable();
            $table->float('PrezzoVendita', 8, 2)->nullable();

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
        Schema::dropIfExists('books');
    }
}
