<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        User::create([
            'name' => 'Alice Dupont',
            'email' => 'alice@example.com',
            'password' => Hash::make('MotDePasse1!'),
            'id_roles' => 1,
        ]);

        User::create([
            'name' => 'Bob Martin',
            'email' => 'bob@example.com',
            'password' => Hash::make('MotDePasse2@'),
            'id_roles' => 2,
        ]);

        User::create([
            'name' => 'Caroline Petit',
            'email' => 'caroline@example.com',
            'password' => Hash::make('MotDePasse3#'),
            'id_roles' => 3,
        ]);

        User::create([
            'name' => 'David Leroy',
            'email' => 'david@example.com',
            'password' => Hash::make('MotDePasse4$'),
            'id_roles' => 1,
        ]);

        User::create([
            'name' => 'Emma Durand',
            'email' => 'emma@example.com',
            'password' => Hash::make('MotDePasse5%'),
            'id_roles' => 5,
        ]);

        User::create([
            'name' => 'Arthur Desfonds',
            'email' => 'arthur@example.com',
            'password' => Hash::make('MotDePasse6-'),
            'id_roles' => 1,
        ]);

        User::create([
            'name' => 'Vcitor',
            'email' => 'V@gmail.com',
            'password' => Hash::make('Stlouis26@'),
            'id_roles' => 1,
        ]);
    }
}
