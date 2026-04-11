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
        $transports = Transport::with('cargaisons')->orderBy('date_depart', 'desc')->get();
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

        // Créer le transport
        $transport = Transport::create([
            'cargaison_id' => $validated['cargaison_id'],
            'date_depart' => $validated['date_depart'],
            'date_arrivee' => $validated['date_arrivee'],
            'destination' => $validated['destination'],
            'statut_transport' => 'En transport', // <- obligatoire
        ]);


        // Mettre à jour le statut de la cargaison
        $cargaison = Cargaison::findOrFail($validated['cargaison_id']);
        $cargaison->statut = 'En transport';
        $cargaison->save();
        // 3. Charger relation
        $transport->load('cargaisons');

        // 4. Générer PDF
        $pdf = Pdf::loadView('back_end.logistique.PDF', compact('transport'));

        $fileName = 'bon_transport_' . $transport->id_transport . '.pdf';

        Storage::disk('public')->makeDirectory('bons');
        // 5. Sauvegarder PDF

        $path = 'bons/'.$fileName;

         Storage::disk('public')->put($path, $pdf->output());


        // 6. Télécharger PDF
        return $pdf->download($fileName);
    }

    /**
     * Affiche un transport précis (bons de transport)
     */
    public function show(string $id)
    {
        $transport = Transport::findOrFail($id);
        return view('back_end.logistique.suivi', compact('transport'));
    }

    /**
     * Met à jour le transport (ex: statut)
     */
    public function update(Request $request, string $id)
    {
        $transport = Transport::findOrFail($id);

        $validated = $request->validate([
            'statut_transport' => 'required|string',
            'date_arrivee' => 'nullable|date',
        ]);

        $transport->update($validated);

        return redirect()->route('transports.index')->with('info', 'Statut mis à jour.');
    }

    public function arrive($id)
    {
        $transport = Transport::findOrFail($id);

        // Mettre à jour le statut du transport si tu veux
        $transport->statut_transport = 'Arrivé';
        $transport->save();

        // Mettre à jour la cargaison
        if ($transport->cargaison) {
            $transport->cargaison->statut = 'Stocké';
            $transport->cargaison->save();
        }

        return redirect()->route('transports.index')->with('success', 'Transport terminé, cargaison mise en stock.');
    }


    public function genererBonTransport($id)
    {
        $transport = Transport::with('cargaisons')->findOrFail($id);

        $pdf = Pdf::loadView('back_end.logistique.PDF', compact('transport'));

        $fileName = 'bon_transport_'.$transport->id_transport.'.pdf';

        Storage::disk('public')->makeDirectory('bons');

        Storage::disk('public')->put('bons/'.$fileName, $pdf->output());



        return $pdf->download($fileName);
    }
}
