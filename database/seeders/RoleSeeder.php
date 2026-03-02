<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id_role' => 1, 'libelle_' => 'Administrateur'],
            ['id_role' => 2, 'libelle_' => 'Direction'],
            ['id_role' => 3, 'libelle_' => 'Chef de site'],
            ['id_role' => 4, 'libelle_' => 'Technicien'],
            ['id_role' => 5, 'libelle_' => 'Service logistique'],
            ['id_role' => 6, 'libelle_' => 'Chercheur'],
            ['id_role' => 7, 'libelle_' => 'Partenaire externe'],
            ['id_role' => 8, 'libelle_' => 'Transporteur'],
        ]);
    }
}
