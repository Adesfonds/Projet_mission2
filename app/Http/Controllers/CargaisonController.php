<?php

namespace App\Http\Controllers;

use App\Models\Minerais;
use Illuminate\Http\Request;
use App\Models\Cargaison;
use App\Models\Site;
use App\Models\Transport;

class CargaisonController extends Controller
{
    /**
     * Affiche toutes les cargaisons et les sites.
     */
    public function index()
    {
        $cargaisons = Cargaison::with(['site', 'users', 'transport', 'minerais'])
            ->orderBy('date_extraction', 'desc')
            ->get();

        $sites = Site::all();
        $minerais = Minerais::all();

        return view('back_end.logistique.mouvement', compact('cargaisons', 'sites', 'minerais'));
    }

    /**
     * Enregistre une nouvelle extraction.
     */
    public function store(Request $request)
    {
        $cargaison = Cargaison::create([
            'date_extraction' => now(),
            'volume' => $request->volume,
            'statut' => 'Extrait',   // Statut initial
            'id_site' => $request->id_site,
            'id_uti' => auth()->id(),
            'id_minerais' => $request->id_minerais,
        ]);

        return redirect()->back()->with('success', 'Extraction enregistrée.');
    }

    /**
     * Met une cargaison en transport.
     */
    public function mettreEnTransport($id_cargaison)
    {
        $cargaison = Cargaison::findOrFail($id_cargaison);

        // Vérifie le statut avant le transport
        if ($cargaison->statut !== 'Extrait') {
            return redirect()->back()->with('error', 'Cette cargaison ne peut pas être mise en transport.');
        }

        // Crée un transport lié
        $transport = Transport::create([
            'date_depart' => now(),
            'date_arrivee' => null,
            'destination' => 'À définir',  // Tu peux ajouter un champ pour choisir la destination
            'statut_transport' => 'En cours',
        ]);

        // Met à jour la cargaison
        $cargaison->statut = 'En transport';
        $cargaison->id_transport = $transport->id_transport;
        $cargaison->save();

        return redirect()->back()->with('success', 'Cargaison mise en transport.');
    }

    /**
     * Met une cargaison en stockage.
     */
    public function mettreEnStockage($id_cargaison)
    {
        $cargaison = Cargaison::findOrFail($id_cargaison);

        // Vérifie le statut avant le stockage
        if ($cargaison->statut !== 'En transport') {
            return redirect()->back()->with('error', 'Cette cargaison ne peut pas être mise en stockage.');
        }

        // Mets à jour le statut de la cargaison
        $cargaison->statut = 'Stocké';
        $cargaison->save();

        // Optionnel : mettre à jour le transport comme terminé
        if ($cargaison->id_transport) {
            $transport = Transport::find($cargaison->id_transport);
            $transport->statut_transport = 'Terminé';
            $transport->date_arrivee = now();
            $transport->save();
        }

        return redirect()->back()->with('success', 'Cargaison mise en stockage.');
    }
}
