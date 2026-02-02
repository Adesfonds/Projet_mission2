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
        Schema::create('role', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('libelle',200);
            $table->unsignedBigInteger('id_uti')->unique();
            $table->foreign('id_uti')
                ->references('id_uti')
                ->on('utilisateur')
                ->onDelete('cascade');

            // CHECK constraint PostgreSQL
            if (config('database.default') === 'pgsql') {
                $table->check("libelle IN ('Admin','Technicien','Chercheur','Logisticien','Direction')");
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
};
