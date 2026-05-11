<?php

namespace App\Http\Controllers;

use App\Models\Mesure;
use Illuminate\Http\Request;

class MesureController extends Controller
{
    public function index(Request $request)
    {
        $query = Mesure::query();

        $query->when($request->date, function ($q) {
            $q->whereDate('horodatage', request('date'));
        });

        $query->when($request->date_debut, function ($q) {
            $q->where('horodatage', '>=', request('date_debut'));
        });

        $query->when($request->date_fin, function ($q) {
            $q->where('horodatage', '<=', request('date_fin'));
        });

        $query->when($request->unite, function ($q) {
            $q->where('unite_mesure', request('unite'));
        });

        $query->when($request->valeur_min, function ($q) {
            $q->where('valeur', '>=', request('valeur_min'));
        });

        $query->when($request->valeur_max, function ($q) {
            $q->where('valeur', '<=', request('valeur_max'));
        });

        $mesures = $query->orderBy('horodatage', 'desc')
            ->paginate(20);

        $unites = Mesure::query()
            ->whereNotNull('unite_mesure')
            ->distinct()
            ->pluck('unite_mesure');

        return view('mesures.index', compact('mesures', 'unites'));
    }

    public function show(string $id)
    {
        $mesure = Mesure::with('collectes')->findOrFail($id);

        return view('mesures.show', compact('mesure'));
    }
}
