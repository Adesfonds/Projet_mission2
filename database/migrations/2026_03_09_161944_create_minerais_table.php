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
        Schema::create('minerais', function (Blueprint $table) {
            $table->id();                           // id_minerais
            $table->string('nom', 100)->unique();   // nom du minerai
            $table->string('description')->nullable(); // description optionnelle
            $table->decimal('densite', 8, 2)->nullable(); // densité (optionnelle)
            $table->timestamps();                   // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minerais');
    }
};
