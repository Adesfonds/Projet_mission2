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
        Schema::create('mouvement_stock', function (Blueprint $table) {
            $table->id('id_mouvement');               // clé primaire
            $table->foreignId('id_uti')->constrained('users'); // utilisateur qui effectue le mouvement
            $table->foreignId('id_materiel')->constrained('materiel'); // matériel concerné
            $table->dateTime('date_mouvement');       // date du mouvement
            $table->string('type_mouvement', 20);     // entrée ou sortie
            $table->integer('quantite');              // quantité déplacée
            $table->timestamps();                     // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_stock');
    }
};
