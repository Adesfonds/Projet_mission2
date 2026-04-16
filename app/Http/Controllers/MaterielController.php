<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel;

class MaterielController extends Controller
{
    /**
     * INVENTAIRE
     */
    public function index()
    {
        $materiels = Materiel::all();
        $alertes = Materiel::whereColumn('stock', '<=', 'seuil_alerte')->get();

        return view('back_end.stock.inventaire_materiel', compact('materiels', 'alertes'));
    }
    /**
     * SUPPRESSION MATERIEL
     */
    public function delete($id)
    {
        $materiel = Materiel::findOrFail($id);
        $materiel->delete();

        return redirect()->back()
            ->with('success', 'Matériel supprimé avec succès');
    }

    /**
     * MOUVEMENT DE STOCK
     */
    public function updateStock(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);

        $request->validate([
            'quantite' => 'required|integer|min:1',
            'type' => 'required|in:entree,sortie'
        ]);

        if ($request->type === 'sortie') {
            $materiel->stock -= $request->quantite;
        } else {
            $materiel->stock += $request->quantite;
        }

        $materiel->save();

        return redirect()->back()->with('success', 'Stock mis à jour.');
    }

    /**
     * CREATION MATERIEL
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

        return redirect()->route('materiel.index')
            ->with('success', 'Matériel ajouté avec succès.');
    }

    /**
     * AFFICHAGE DETAIL
     */
    public function show($id)
    {
        $materiel = Materiel::findOrFail($id);

        return view('back_end.stock.modif', compact('materiel'));
    }
    /**
     * UPDATE MATERIEL (CORRIGE)
     */
    public function update(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'seuil_alerte' => 'required|integer'
        ]);

        $materiel->update($validated);

        return redirect()->back()
            ->with('success', 'Matériel mis à jour avec succès.');
    }
}
