<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Fournisseur;
use App\Models\Materiel;

class CommandeController extends Controller
{
    /**
     * SUIVI DES APPROVISIONNEMENTS
     * Remplace le manque de procédure automatisée.
     */
    public function index()
    {
        // On récupère les commandes avec le nom du fournisseur
        $commandes = Commande::with('fournisseur')->orderBy('date_commande', 'desc')->get();
        return view('back.commandes.index', compact('commandes'));
    }

    /**
     * Formulaire de commande
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        $materiels = Materiel::all();
        return view('back.commandes.create', compact('fournisseurs', 'materiels'));
    }

    /**
     * PASSAGE DE COMMANDE NUMÉRIQUE
     * Enregistre la commande et lie les produits via la table pivot
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_fournisseur' => 'required|exists:fournisseur,id_fournisseur',
            'status_commande' => 'required|string',
            'materiels' => 'required|array', // Tableau d'ID de matériel
        ]);

        // 1. Création de la commande
        $commande = Commande::create([
            'date_commande' => now(),
            'status_commande' => $request->status_commande,
            'id_fournisseur' => $request->id_fournisseur,
        ]);

        // 2. Liaison avec le matériel (Table "contenir" ou pivot)
        // On imagine que tu passes aussi une quantité pour chaque matériel
        foreach ($request->materiels as $id_mat => $details) {
            $commande->materiels()->attach($id_mat, ['quantite' => $details['qte']]);
        }

        return redirect()->route('commandes.index')->with('success', 'Commande fournisseur enregistrée.');
    }

    /**
     * RÉCEPTION DE COMMANDE
     * Met à jour le statut et incrémente automatiquement le stock matériel
     */
    public function update(Request $request, string $id)
    {
        $commande = Commande::findOrFail($id);

        // Si la commande passe à "Livrée", on met à jour les stocks de la foreuse
        if ($request->status_commande == 'Livrée' && $commande->status_commande != 'Livrée') {
            foreach ($commande->materiels as $materiel) {
                $materiel->increment('stock', $materiel->pivot->quantite);
            }
        }

        $commande->update(['status_commande' => $request->status_commande]);

        return redirect()->back()->with('success', 'Statut mis à jour et stocks actualisés.');
    }
}
