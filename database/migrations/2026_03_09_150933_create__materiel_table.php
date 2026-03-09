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
        Schema::create('materiel', function (Blueprint $table) {
            $table->id('id_materiel');          // clé primaire
            $table->string('nom', 50);          // nom du matériel
            $table->string('description', 100)->nullable(); // description optionnelle
            $table->integer('stock');           // quantité en stock
            $table->integer('seuil_alerte');   // seuil d'alerte
            $table->timestamps();               // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiel');
    }
};
