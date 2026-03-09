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
        Schema::create('transport', function (Blueprint $table) {
            $table->id('id_transport');            // clé primaire
            $table->date('date_depart');           // date de départ du transport
            $table->date('date_arrivee')->nullable(); // date d'arrivée (peut être null si pas encore arrivé)
            $table->string('destination', 150);   // lieu de destination
            $table->string('statut_transport', 50); // statut du transport (ex: en cours, livré)
            $table->timestamps();                  // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport');
    }
};
