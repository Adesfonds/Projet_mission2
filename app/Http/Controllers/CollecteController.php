<?php

namespace App\Http\Controllers;

use App\Models\Collecte;
use App\Models\Capteur;
use App\Models\Mesure;
use Illuminate\Http\Request;

class CollecteController extends Controller
{
    public function index(Request $request)
    {
        $collectes = Collecte::with(['capteur', 'mesure'])
            ->when($request->type_capteur, function ($q) use ($request) {
                $q->whereHas('capteur', function ($q2) use ($request) {
                    $q2->where('type_capteur', $request->type_capteur);
                });
            })
            ->when($request->id_capt, function ($q) use ($request) {
                $q->where('id_capt', $request->id_capt);
            })
            ->when($request->id_mesure_, function ($q) use ($request) {
                $q->where('id_mesure_', $request->id_mesure_);
            })
            ->paginate(20);

        $capteurs = Capteur::all();
        $mesures = Mesure::all();
        $types = Capteur::distinct()->pluck('type_capteur');

        return view('collectes.index', compact(
            'collectes',
            'capteurs',
            'mesures',
            'types'
        ));
    }

    public function show($id_capt, $id_mesure_)
    {
        $collecte = Collecte::with(['capteur', 'mesure'])
            ->where('id_capt', $id_capt)
            ->where('id_mesure_', $id_mesure_)
            ->firstOrFail();

        return view('collectes.show', compact('collecte'));
    }
}
