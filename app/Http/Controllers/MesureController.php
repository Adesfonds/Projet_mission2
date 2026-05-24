<?php

namespace App\Http\Controllers;

use App\Models\Mesure;
use Illuminate\Http\Request;

class MesureController extends Controller
{
    public function index(Request $request)
    {
        $query = Mesure::query();

        $query->when($request->date, fn($q) =>
        $q->where('horodatage', $request->date)
        );

        $query->when($request->date_debut, fn($q) =>
        $q->where('horodatage', '>=', $request->date_debut)
        );

        $query->when($request->date_fin, fn($q) =>
        $q->where('horodatage', '<=', $request->date_fin)
        );

        $query->when($request->unite, fn($q) =>
        $q->where('unite', $request->unite) // ← corrigé
        );

        $query->when($request->valeur_min, fn($q) =>
        $q->where('valeur', '>=', $request->valeur_min)
        );

        $query->when($request->valeur_max, fn($q) =>
        $q->where('valeur', '<=', $request->valeur_max)
        );

        $mesures = $query->orderBy('horodatage', 'desc')->paginate(20);

        $unites = Mesure::whereNotNull('unite')
            ->distinct()
            ->pluck('unite'); // ← corrigé

        return view('mesures.index', compact('mesures', 'unites'));
    }
    public function show(string $id)
    {
        $mesure = Mesure::with('collectes')->findOrFail($id);

        return view('mesures.show', compact('mesure'));
    }
}
