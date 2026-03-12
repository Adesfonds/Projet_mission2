<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel;

class MaterielController extends Controller
{
    /**
     * INVENTAIRE NUMÉRIQUE
     * Affiche tout le matériel avec mise en évidence des stocks bas.
     */
    public function index()
    {
        $materiels = Materiel::all();
        // On récupère spécifiquement les éléments en alerte pour le tableau de bord
        $alertes = Materiel::whereColumn('stock', '<=', 'seuil_alerte')->get();

        return view('back_end.stock.stock', compact('materiels', 'alertes'));
    }

    /**
     * ENREGISTREMENT D'UNE SORTIE/ENTRÉE DE STOCK
     * Remplace la fiche papier du hangar.
     */
    public function updateStock(Request $request, string $id)
    {
        $materiel = Materiel::findOrFail($id);

        $request->validate([
            'quantite' => 'required|integer',
            'type' => 'required|in:entree,sortie'
        ]);

        if ($request->type == 'sortie') {
            $materiel->stock -= $request->quantite;
        } else {
            $materiel->stock += $request->quantite;
        }

        $materiel->save();

        // Plus-value : Vérification automatique du seuil après mouvement
        if ($materiel->stock <= $materiel->seuil_alerte) {
            // Ici, Laravel pourrait envoyer un mail automatique au service logistique
        }

        return redirect()->back()->with('success', 'Stock mis à jour.');
    }

    /**
     * CRÉATION D'UN NOUVEL OUTIL
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
        ]);

        Materiel::create($validated);

        return redirect()->route('materiel.index')->with('success', 'Nouvel outil inventorié.');
    }

    public function show(string $id)
    {
        $materiel = Materiel::with('commandes')->findOrFail($id);
        return view('back.materiel.show', compact('materiel'));
    }
}
