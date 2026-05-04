<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Fournisseur;
use App\Models\Materiel;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * LISTE COMMANDES
     */
    public function index()
    {
        $commandes = Commande::with('fournisseur')
            ->orderByDesc('date_commande')
            ->get();

        return view('back_end.stock.suivre_commande', compact('commandes'));
    }

    /**
     * FORMULAIRE
     */
    public function create()
    {
        return view('back.commandes.create', [
            'fournisseurs' => Fournisseur::all(),
            'materiels' => Materiel::all()
        ]);
    }

    /**
     * CREER COMMANDE
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_fournisseur' => 'required|exists:fournisseur,id_fournisseur',
            'materiels' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {

            // 1. Création commande
            $commande = Commande::create([
                'date_commande' => now(),
                'statut_commande' => 'en_attente',
                'id_fournisseur' => $request->id_fournisseur
            ]);

            // 2. Ajout matériels
            foreach ($request->materiels as $id => $data) {

                if (!empty($data['quantite'])) {
                    $commande->materiels()->attach($id, [
                        'quantite' => (int) $data['quantite']
                    ]);
                }
            }
        });

        return redirect()->route('commandes.index')
            ->with('success', 'Commande créée avec succès');
    }

    /**
     * RECEPTION COMMANDE
     */
    public function update(Request $request, $id)
    {
        $commande = Commande::with('materiels')->findOrFail($id);

        $nouveauStatut = $request->statut_commande;

        DB::transaction(function () use ($commande, $nouveauStatut) {

            // Si passage à livrée
            if (
                $nouveauStatut === 'livree'
                && $commande->statut_commande !== 'livree'
            ) {
                foreach ($commande->materiels as $materiel) {
                    $materiel->increment('stock', $materiel->pivot->quantite);
                }
            }

            $commande->update([
                'statut_commande' => $nouveauStatut
            ]);
        });

        return back()->with('success', 'Commande mise à jour');
    }
}
