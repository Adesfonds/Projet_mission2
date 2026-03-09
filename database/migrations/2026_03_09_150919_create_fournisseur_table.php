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
        Schema::create('fournisseur', function (Blueprint $table) {
            $table->id('id_fournisseur');          // clé primaire auto-incrémentée
            $table->string('nom', 100);            // nom du fournisseur
            $table->string('telephone', 20);       // téléphone
            $table->string('email', 100)->unique(); // email unique
            $table->timestamps();                  // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseur');
    }
};
