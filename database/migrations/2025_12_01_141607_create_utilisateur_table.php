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
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id('id_uti');
            $table->string('uti_nom',100);
            $table->string('uti_mdp',200);
            $table->string('email',100)->unique();
            $table->timestamps(); // <-- crée automatiquement created_at et updated_at

            if (config('database.default') === 'pgsql') {
                $table->check("email LIKE '%_@_%._%'");
                $table->check("uti_mdp ~ '^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[\\W_]).{8,}$'");
            }


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};
