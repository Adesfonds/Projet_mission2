<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    /**
     * Afficher la liste des rapports
     */
    public function index()
    {
        $rapports = Rapport::all();

        return view('rapports.index', compact('rapports'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('rapports.create');
    }

    /**
     * Enregistrer un nouveau rapport
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'type' => 'required|in:mensuel,trimestriel',
            'date_rapport' => 'required|date',
        ]);

        Rapport::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'type' => $request->type,
            'date_rapport' => $request->date_rapport,
        ]);

        return redirect()->route('rapports.index')
            ->with('success', 'Rapport ajouté avec succès');
    }

    /**
     * Afficher un rapport
     */
    public function show(Rapport $rapport)
    {
        return view('Front-end.rapports_enviro.rapport', compact('rapport'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Rapport $rapport)
    {
        return view('rapports.edit', compact('rapport'));
    }

    /**
     * Mettre à jour un rapport
     */
    public function update(Request $request, Rapport $rapport)
    {
        $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'type' => 'required|in:mensuel,trimestriel',
            'date_rapport' => 'required|date',
        ]);

        $rapport->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'type' => $request->type,
            'date_rapport' => $request->date_rapport,
        ]);

        return redirect()->route('rapports.index')
            ->with('success', 'Rapport modifié avec succès');
    }

    /**
     * Supprimer un rapport
     */
    public function destroy(Rapport $rapport)
    {
        $rapport->delete();

        return redirect()->route('rapports.index')
            ->with('success', 'Rapport supprimé avec succès');
    }

    public function mensuel()
    {
        $rapports = Rapport::where('type', 'mensuel')
            ->orderBy('date_rapport', 'desc')
            ->paginate(9);

        return view('Front-end.rapports_enviro.rapport_mensuels', compact('rapports'));
    }

    public function trimestriel()
    {
        $rapports = Rapport::where('type', 'trimestriel')
            ->orderBy('date_rapport', 'desc')
            ->paginate(9);

        return view('Front-end.rapports_enviro.rapport_trimestriel', compact('rapports'));
    }

    public function archive()
    {
        $rapports = Rapport::orderBy('date_rapport', 'desc')
            ->paginate(9);

        return view('Front-end.rapports_enviro.archive', compact('rapports'));
    }
}
