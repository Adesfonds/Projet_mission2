<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
    /**
     * Liste des sites d'extraction.
     * Idéal pour le tableau de bord de la Direction.
     */
    public function index()
    {
        $sites = Site::all();
        return view('back.sites.index', compact('sites'));
    }

    /**
     * Enregistrement d'un nouveau site de forage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:200',
            'localisation' => 'required|string|max:200',
        ]);

        Site::create($validated);

        return redirect()->route('sites.index')->with('success', 'Nouveau site ajouté au réseau VEM.');
    }

    /**
     * LA PLUS-VALUE : Vue détaillée du site (ex: Vercors).
     * Centralise toutes les données liées à un lieu géographique.
     */
    public function show(string $id)
    {
        // On charge le site avec ses relations pour éviter les requêtes inutiles (Eager Loading)
        $site = Site::with(['cargaisons', 'releves'])->findOrFail($id);

        // On calcule quelques statistiques rapides pour le back-office
        $volumeTotal = $site->cargaisons->sum('volume');
        $derniersReleves = $site->releves()->orderBy('date', 'desc')->take(5)->get();

        return view('back.sites.show', compact('site', 'volumeTotal', 'derniersReleves'));
    }

    /**
     * Mise à jour des informations du site.
     */
    public function update(Request $request, string $id)
    {
        $site = Site::findOrFail($id);
        $site->update($request->validate([
            'nom' => 'sometimes|string|max:200',
            'localisation' => 'sometimes|string|max:200',
        ]));

        return redirect()->route('sites.show', $id)->with('success', 'Coordonnées du site mises à jour.');
    }
}
