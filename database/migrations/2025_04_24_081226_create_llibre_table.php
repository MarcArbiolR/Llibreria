<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Creació de la taula llibre per emmagatzemar informació dels llibres
        Schema::create('llibre', function (Blueprint $table) {
            $table->id();
            $table->string('titol');
            $table->string('autor');
            $table->string('resum');
            $table->date('data_publicacio');
            $table->decimal('preu', 8, 2); // Preu amb dues decimals
            $table->string('imatge')->nullable(); // Imatge opcional
            $table->integer('edat_minima')->nullable(); // Edat mínima opcional
            $table->foreignId('categoria_id')->constrained('categories')->cascadeOnDelete(); // Referència a la taula categories
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llibre');
    }
};
