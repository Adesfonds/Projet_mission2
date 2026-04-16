<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MouvementStock;
use App\Models\Materiel;
use Barryvdh\DomPDF\Facade\Pdf;

class MouvementStockController extends Controller
{
    public function index()
    {
        $mouvements = MouvementStock::with(['materiel', 'users'])
            ->orderBy('date_mouvement', 'desc')
            ->get();

        return view('back_end.stock.suivi_stock.blade.php', compact('mouvements'));
    }
    public function entree(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);

        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

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

        return back()->with('success', 'Entrée de stock effectuée');
    }

    public function sortie(Request $request, $id)
    {
        $materiel = Materiel::findOrFail($id);

        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

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

        return back()->with('success', 'Sortie de stock effectuée');
    }

}
