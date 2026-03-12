<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;

class TransportController extends Controller
{
    /**
     * SUIVI EN TEMPS RÉEL
     * Remplace le tableau noir ou le cahier papier.
     */
    public function index()
    {
        $transports = Transport::orderBy('date_depart', 'desc')->get();
        return view('transports.index', compact('transports'));
    }

    /**
     * ENREGISTREMENT DU MOUVEMENT
     * Remplace l'instruction donnée par téléphone.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_depart' => 'required|date',
            'destination' => 'required|string',
            'statut_transport' => 'required|string', // ex: 'Prêt', 'En cours'
        ]);

        Transport::create($validated);

        return redirect()->route('transports.index')->with('success', 'Transport planifié avec succès.');
    }

    /**
     * GÉNÉRATION DU BON DE TRANSPORT (VIRTUEL)
     * Montre les détails d'une cargaison précise.
     */
    public function show(string $id)
    {
        $transport = Transport::findOrFail($id);
        // Ici, on pourrait appeler une vue spéciale "Bon de Transport" à imprimer
        return view('transports.show', compact('transport'));
    }

    /**
     * TRACAGE DES DÉPLACEMENTS
     * Permet de mettre à jour le statut dès que le chauffeur arrive.
     */
    public function update(Request $request, string $id)
    {
        $transport = Transport::findOrFail($id);

        $request->validate([
            'statut_transport' => 'required|string',
            'date_arrivee' => 'nullable|date'
        ]);

        $transport->update($request->all());

        return redirect()->route('transports.index')->with('info', 'Statut mis à jour.');
    }
}
