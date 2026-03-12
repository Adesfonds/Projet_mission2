<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;

class FournisseurController extends Controller
{
    /**
     * Liste des fournisseurs (Annuaire centralisé)
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('back.fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Formulaire d'ajout (Remplace le carnet d'adresses papier)
     */
    public function create()
    {
        return view('back.fournisseurs.create');
    }

    /**
     * Enregistrement d'un nouveau partenaire
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'telephone' => 'required|string|max:15',
            'email' => 'required|email|max:50',
        ]);

        Fournisseur::create($validated);

        return redirect()->route('fournisseurs.index')->with('success', 'Fournisseur ajouté au système.');
    }

    /**
     * Affiche un fournisseur et l'historique de ses commandes
     */
    public function show(string $id)
    {
        // On utilise eager loading pour charger les commandes liées
        $fournisseur = Fournisseur::with('commandes')->findOrFail($id);
        return view('back.fournisseurs.show', compact('fournisseur'));
    }

    /**
     * Modification des coordonnées
     */
    public function update(Request $request, string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:100',
            'telephone' => 'sometimes|string|max:15',
            'email' => 'sometimes|email|max:50',
        ]);

        $fournisseur->update($validated);

        return redirect()->route('fournisseurs.index')->with('success', 'Coordonnées mises à jour.');
    }

    /**
     * Suppression (si aucune commande en cours)
     */
    public function destroy(string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);

        if($fournisseur->commandes()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer un fournisseur ayant des commandes actives.');
        }

        $fournisseur->delete();
        return redirect()->route('fournisseurs.index');
    }
}
