<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Utilisateur;

class RoleController extends Controller
{

    public function tableauBord()
    {
        $sessionUser = session('utilisateur');

        if (!$sessionUser) {
            return redirect()->route('login.form');
        }

        // Récupération via Eloquent avec la relation 'role'
        $user = Utilisateur::with('role')->find($sessionUser->id_uti);

        return view('back_end.tableau_bord', compact('user'));
    }

    public function gestionRoles()
    {
        $user = auth()->user(); // utilisateur connecté

        if (!$user) {
            return redirect()->route('login.form');
        }

        $user->load('role'); // charge la relation role
        $role = $user->role;

        $pagesParRole = [
            'Admin' => [
                ['name' => 'Gestion des utilisateurs', 'route' => 'gestion_utilisateur'],
                ['name' => 'Journalisation', 'route' => 'journal'],
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ],
            'Technicien' => [
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain'],
                ['name' => 'Journalisation', 'route' => 'journal']
            ],
            'Logisticien' => [
                ['name' => 'Logistique', 'route' => 'logistique'],
                ['name' => 'Stock', 'route' => 'stock']
            ],
            'Direction' => [
                ['name' => 'Gestion des utilisateurs', 'route' => 'gestion_utilisateur'],
                ['name' => 'Journalisation', 'route' => 'journal'],
                ['name' => 'Logistique', 'route' => 'logistique'],
                ['name' => 'Stock', 'route' => 'stock'],
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ]
        ];

        $pages = $pagesParRole[$role->libelle ?? ''] ?? [];

        return view('back_end.roles', compact('user', 'role', 'pages'));
    }



}
