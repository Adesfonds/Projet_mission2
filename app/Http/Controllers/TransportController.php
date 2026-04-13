<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use App\Models\Cargaison;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class TransportController extends Controller
{
    /**
     * Affiche tous les transports
     */
    public function index()
    {
        $transports = Transport::with('cargaisons')
            ->orderBy('date_depart', 'desc')
            ->get();

        $cargaisons = Cargaison::all();

        return view('back_end.logistique.suivi', compact('transports', 'cargaisons'));
    }

    /**
     * Enregistre un nouveau transport
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cargaison_id' => 'required|exists:cargaison,id_cargaison',
            'date_depart' => 'required|date',
            'date_arrivee' => 'required|date',
            'destination' => 'required|string',
        ]);

        // ✅ 1. Créer le transport (SANS cargaison_id)
        $transport = Transport::create([
            'date_depart' => $validated['date_depart'],
            'date_arrivee' => $validated['date_arrivee'],
            'destination' => $validated['destination'],
            'statut_transport' => 'En transport',
        ]);

        // ✅ 2. Lier la cargaison au transport
        $cargaison = Cargaison::findOrFail($validated['cargaison_id']);
        $cargaison->id_transport = $transport->id_transport;
        $cargaison->statut = 'En transport';
        $cargaison->save();

        // ✅ 3. Charger relation
        $transport->load('cargaisons');

        // ✅ 4. Générer PDF
        $pdf = Pdf::loadView('back_end.logistique.PDF', compact('transport'));
        $fileName = 'bon_transport_' . $transport->id_transport . '.pdf';

        Storage::disk('public')->makeDirectory('bons');
        Storage::disk('public')->put('bons/' . $fileName, $pdf->output());

        return $pdf->download($fileName);
    }

    /**
     * Affiche un transport précis
     */
    public function show(string $id)
    {
        $transport = Transport::with('cargaisons')->findOrFail($id);
        return view('back_end.logistique.suivi', compact('transport'));
    }

    /**
     * Met à jour le transport
     */
    public function update(Request $request, string $id)
    {
        $transport = Transport::findOrFail($id);

        $validated = $request->validate([
            'statut_transport' => 'required|string',
            'date_arrivee' => 'nullable|date',
        ]);

        $transport->update($validated);

        return redirect()->route('transports.index')
            ->with('info', 'Statut mis à jour.');
    }

    /**
     * Marquer comme arrivé
     */
    public function arrive($id)
    {
        $transport = Transport::with('cargaisons')->findOrFail($id);

        // ✅ Mettre à jour le transport
        $transport->statut_transport = 'Arrivé';
        $transport->save();

        // ✅ Mettre à jour TOUTES les cargaisons liées
        foreach ($transport->cargaisons as $cargaison) {
            $cargaison->statut = 'Stocké';
            $cargaison->save();
        }

        return redirect()->route('transports.index')
            ->with('success', 'Transport terminé, cargaisons mises en stock.');
    }

    /**
     * Générer PDF
     */
    public function genererBonTransport($id)
    {
        $transport = Transport::with('cargaisons')->findOrFail($id);

        $pdf = Pdf::loadView('back_end.logistique.PDF', compact('transport'));
        $fileName = 'bon_transport_' . $transport->id_transport . '.pdf';

        Storage::disk('public')->makeDirectory('bons');
        Storage::disk('public')->put('bons/' . $fileName, $pdf->output());

        return $pdf->download($fileName);
    }

    /**
     * Liste des PDF
     */
    public function listePDF()
    {
        $files = Storage::disk('public')->files('bons');
        return view('back_end.logistique.liste_pdf', compact('files'));
    }
}
