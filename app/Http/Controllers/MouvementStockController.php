<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MouvementStock;
use App\Models\Materiel;
use Barryvdh\DomPDF\Facade\Pdf;

class MouvementStockController extends Controller
{
    /**
     * HISTORIQUE DES MOUVEMENTS
     */
    public function index()
    {
        $mouvements = MouvementStock::with(['materiel', 'utilisateur'])
            ->orderBy('date_mouvement', 'desc')
            ->get();

        return view('back_end.stock.suivi_stock', compact('mouvements'));
    }

    /**
     * ENTREE DE STOCK
     */
    public function entree(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);

        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

        if ($request->quantite <= 0) {
            return back()->with('error', 'Quantité invalide');
        }

        // mise à jour stock
        $materiel->stock += $request->quantite;
        $materiel->save();

        // log mouvement
        MouvementStock::create([
            'id_uti' => auth()->id(),
            'id_materiel' => $materiel->id_materiel,
            'type_mouvement' => 'entree',
            'quantite' => $request->quantite,
            'date_mouvement' => now()
        ]);

        // alerte seuil
        if ($materiel->stock <= $materiel->seuil_alerte) {
            session()->flash('warning', 'Stock critique atteint pour ce matériel');
        }

        return back()->with('success', 'Entrée de stock effectuée');
    }

    /**
     * SORTIE DE STOCK
     */
    public function sortie(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);

        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

        if ($request->quantite <= 0) {
            return back()->with('error', 'Quantité invalide');
        }

        if ($materiel->stock < $request->quantite) {
            return back()->with('error', 'Stock insuffisant');
        }

        $materiel->stock -= $request->quantite;
        $materiel->save();

        MouvementStock::create([
            'id_uti' => auth()->id(),
            'id_materiel' => $materiel->id_materiel,
            'type_mouvement' => 'sortie',
            'quantite' => $request->quantite,
            'date_mouvement' => now()
        ]);

        if ($materiel->stock <= $materiel->seuil_alerte) {
            session()->flash('warning', 'Stock critique atteint pour ce matériel');
        }

        return back()->with('success', 'Sortie de stock effectuée');
    }
}
