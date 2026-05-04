<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MouvementStock;
use App\Models\Materiel;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request, $id) {

            $materiel = Materiel::lockForUpdate()->findOrFail($id);

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
        });


        return back()->with('success', 'Entrée de stock effectuée');
    }

    /**
     * SORTIE DE STOCK
     */
    public function sortie(Request $request, $id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request, $id) {

                $materiel = Materiel::lockForUpdate()->findOrFail($id);

                if ($materiel->stock < $request->quantite) {
                    throw new \Exception('Stock insuffisant');
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
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Sortie de stock effectuée');
    }
}
