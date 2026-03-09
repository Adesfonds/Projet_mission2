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
        Schema::create('commande', function (Blueprint $table) {
            $table->id('id_commande');               // clé primaire
            $table->date('date_commande');           // date de la commande
            $table->string('statut_commande', 50);   // statut (ex: en attente, livrée)

            // Relation avec le fournisseur
            $table->foreignId('id_fournisseur')->constrained('fournisseur');

            $table->timestamps();                    // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande');
    }
};
