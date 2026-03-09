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
Schema::create('cargaison', function (Blueprint $table) {
$table->id('id_cargaison');                // clé primaire
$table->date('date_extraction');           // date de l'extraction
$table->decimal('volume', 15, 2);          // volume de minerai
$table->string('statut', 50);              // statut (ex: extrait, transporté)

// Relations
$table->foreignId('id_transport')->nullable()->constrained('transport');
$table->foreignId('id_site')->constrained('sites');
$table->foreignId('id_uti')->constrained('utilisateur_');

$table->timestamps();                       // created_at & updated_at
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('cargaison');
}
};
