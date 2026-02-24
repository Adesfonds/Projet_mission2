<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // charge la relation role (pas roles)
        $user->load('role');

        $role = $user->role;

        $pagesParRole = [
            'Administrateur' => [
                ['name' => 'Gestion des utilisateurs', 'route' => 'gestion_utilisateur'],
                ['name' => 'Logistique', 'route' => 'logistique'],
                ['name' => 'Stock', 'route' => 'stock'],
                ['name' => 'Journalisation', 'route' => 'journal'],
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ],
            'Direction' => [
                ['name' => 'Gestion des utilisateurs', 'route' => 'gestion_utilisateur'],
                ['name' => 'Logistique', 'route' => 'logistique'],
                ['name' => 'Stock', 'route' => 'stock'],
                ['name' => 'Journalisation', 'route' => 'journal'],
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ],
            'Chef de site' => [
                ['name' => 'Logistique', 'route' => 'logistique'],
                ['name' => 'Stock', 'route' => 'stock'],
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ],
            'Technicien' => [
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain'],
                ['name' => 'Journalisation', 'route' => 'journal']
            ],
            'Service logistique' => [
                ['name' => 'Logistique', 'route' => 'logistique'],
                ['name' => 'Stock', 'route' => 'stock']
            ],
            'Chercheur' => [
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ],
            'Partenaire externe' => [
                ['name' => 'Relevés de terrain', 'route' => 'releves_terrain']
            ],
            'Transporteur' => [
                ['name' => 'Logistique', 'route' => 'logistique']
            ],
        ];

        $pages = $pagesParRole[$role->libelle ?? ''] ?? [];

        return view('back_end.roles', compact('user', 'role', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
