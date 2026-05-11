<?php

namespace App\Http\Controllers;

use App\Models\Capteur;
use App\Models\Mesure;
use App\Models\Collecte;

class ReleveTerrainController extends Controller
{
    public function index()
    {
        $capteurs = Capteur::query()
            ->when(request('type_capteur'), fn($q) =>
            $q->where('type_capteur', request('type_capteur'))
            )
            ->when(request('localisation'), fn($q) =>
            $q->where('localisation', request('localisation'))
            )
            ->when(request('unite'), fn($q) =>
            $q->where('unite_mesure', request('unite'))
            )
            ->paginate(20);

        $collectes = Collecte::with(['capteur', 'mesure'])
            ->when(request('type_capteur'), fn($q) =>
            $q->whereHas('capteur', fn($q2) =>
            $q2->where('type_capteur', request('type_capteur'))
            )
            )
            ->when(request('unite'), fn($q) =>
            $q->whereHas('mesure', fn($q2) =>
            $q2->where('unite_mesure', request('unite'))
            )
            )
            ->paginate(20);

        $types = Capteur::distinct()->pluck('type_capteur');
        $unites = Capteur::distinct()->pluck('unite_mesure');
        $localisations = Capteur::distinct()->pluck('localisation');
        $fabricants = Capteur::distinct()->pluck('fabricant');

        return view('back_end.releve_terrain.releves_terrain', compact(
            'capteurs',
            'collectes',
            'types',
            'unites',
            'localisations',
            'fabricants'
        ));
    }
}
