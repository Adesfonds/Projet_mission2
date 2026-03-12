<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Minerais;

class MineraisController extends Controller
{
    /**
     * Catalogue des ressources (Consultable par les Chercheurs et la Logistique)
     */
    public function index()
    {
        $minerais = Minerais::all();
        return view('back.minerais.index', compact('minerais'));
    }

    /**
     * Ajout d'un nouveau type de minerai découvert
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|unique:minerais,nom|max:100',
            'description' => 'nullable|string|max:255',
            'densite' => 'required|numeric|min:0',
        ]);

        Minerais::create($validated);

        return redirect()->route('minerais.index')->with('success', 'Nouveau minerai référencé.');
    }

    /**
     * Détails d'un minerai et historique de ses extractions
     */
    public function show(string $id)
    {
        // On récupère le minerai avec ses cargaisons liées (Eager Loading)
        $minerai = Minerais::with('cargaisons.site')->findOrFail($id);

        return view('back.minerais.show', compact('minerai'));
    }
}
