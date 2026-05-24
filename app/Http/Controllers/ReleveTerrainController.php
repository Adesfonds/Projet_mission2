<?php

namespace App\Http\Controllers;

use App\Models\Capteur;
use App\Models\Mesure;
use App\Models\Collecte;
use Illuminate\Http\Request;
class ReleveTerrainController extends Controller
{
    public function index(Request $request)
    {
        // Capteurs filtrés
        $capteursQuery = Capteur::query();

        $capteursQuery->when($request->type_capteur, fn($q) =>
        $q->where('type_capteur', $request->type_capteur)
        );

        $capteursQuery->when($request->localisation, fn($q) =>
        $q->where('localisation', $request->localisation)
        );

        $capteurs = $capteursQuery->get();

        // Collectes filtrées
        $collectesQuery = Collecte::with('mesure', 'capteur')
            ->join('capteur_', 'collecte_.id_capt', '=', 'capteur_.id_capt')
            ->join('mesure_', 'collecte_.id_mesure_', '=', 'mesure_.id_mesure_');

        $collectesQuery->when($request->type_capteur, fn($q) =>
        $q->where('capteur_.type_capteur', $request->type_capteur)
        );

        $collectesQuery->when($request->localisation, fn($q) =>
        $q->where('capteur_.localisation', $request->localisation)
        );

        $collectesQuery->when($request->date, fn($q) =>
        $q->where('mesure_.horodatage', $request->date)
        );

        $collectes = $collectesQuery
            ->orderBy('mesure_.horodatage', 'desc')
            ->select('collecte_.*')
            ->paginate(20);

        $types = Capteur::distinct()->pluck('type_capteur');
        $localisations = Capteur::distinct()->pluck('localisation');

        return view('back_end.releve_terrain.releves_terrain', compact(
            'capteurs',
            'collectes',
            'types',
            'localisations'
        ));
    }
}
