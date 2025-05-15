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
        // Creació de la taula llibre_user per gestionar la relació molts a molts entre llibres i usuaris
        Schema::create('llibre_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade'); // Referència a la taula users
            $table->foreignId('llibre_id')->references('id')->on('llibre')->onDelete('cascade'); // Referència a la taula llibres
            $table->integer('nota')->default(0)->max(10); // Nota assignada pel llibre
            $table->text('valoracio')->nullable(); // Comentari sobre el llibre
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llibre_user');
    }
};
