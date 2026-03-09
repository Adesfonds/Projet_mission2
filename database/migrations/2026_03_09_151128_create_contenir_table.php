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
        Schema::create('contenir', function (Blueprint $table) {
            $table->foreignId('id_materiel')->constrained('materiel'); // référence Materiel
            $table->foreignId('id_commande')->constrained('commande'); // référence Commande
            $table->integer('quantite');                                // quantité commandée
            $table->primary(['id_materiel', 'id_commande']);           // clé primaire composée
            $table->timestamps();                                       // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenir');
    }
};
