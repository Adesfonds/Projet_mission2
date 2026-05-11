<?php

namespace App\Http\Controllers;

use App\Models\Capteur;
use Illuminate\Http\Request;

class CapteurController extends Controller
{
    public function index(Request $request)
    {
        $query = Capteur::query();

        // Filtres selon les vraies colonnes de ta table
        if ($request->filled('type_capteur'))
            $query->where('type_capteur', $request->type_capteur);

        if ($request->filled('localisation'))
            $query->where('localisation', $request->localisation);

        if ($request->filled('fabricant'))
            $query->where('fabricant', $request->fabricant);

        $capteurs = $query->paginate(20);

        // Listes pour les selects du formulaire
        $types        = Capteur::distinct()->pluck('type_capteur');
        $localisations = Capteur::distinct()->pluck('localisation');
        $fabricants   = Capteur::distinct()->pluck('fabricant');

        return view('capteurs.index', compact('capteurs', 'types', 'localisations', 'fabricants'));
    }

    public function show(Capteur $capteur)
    {
        return view('capteurs.show', compact('capteur'));
    }
}
