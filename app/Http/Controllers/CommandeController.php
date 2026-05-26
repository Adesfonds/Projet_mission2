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
     * LISTE DES COMMANDES (SUIVI)
     */
    public function index(Request $request)
    {
        $query = Commande::with('fournisseur')
            ->orderByDesc('date_commande');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('id_commande', 'like', '%' . $request->search . '%')
                    ->orWhere('statut_commande', 'like', '%' . $request->search . '%')
                    ->orWhereHas('fournisseur', function ($q2) use ($request) {
                        $q2->where('nom', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $commandes = $query->get();

        return view('back_end.stock.suivre_commande', compact('commandes'));
    }

    /**
     * FORMULAIRE DE CREATION
     */
    public function create()
    {
        return view('back_end.stock.passer_commande', [
            'fournisseurs' => Fournisseur::all(),
            'materiels' => Materiel::all()
        ]);
    }

    /**
     * ENREGISTRER UNE COMMANDE
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_fournisseur' => 'required|exists:fournisseur,id_fournisseur',
            'materiels' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {

            $commande = Commande::create([
                'date_commande' => now(),
                'statut_commande' => 'en_attente',
                'id_fournisseur' => $request->id_fournisseur
            ]);

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
     * MISE A JOUR STATUT + STOCK
     */
    public function update(Request $request, $id)
    {
        $commande = Commande::with('materiels')->findOrFail($id);

        $nouveauStatut = $request->statut_commande;

        DB::transaction(function () use ($commande, $nouveauStatut) {

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
