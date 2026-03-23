<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargaison;
use App\Models\Site;

class CargaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargaisons = Cargaison::with(['site','users','transport'])
            ->orderBy('date_extraction','desc')
            ->get();

        $sites = Site::all(); // <-- ici on récupère toutes les sites via le modèle

        return view('back_end.logistique.mouvement', compact('cargaisons', 'sites'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cargaison = Cargaison::create([
            'date_extraction' => now(),
            'volume' => $request->volume,
            'statut' => 'En attente de transport',
            'id_transport' =>$request->id_transport,
            'id_site' => $request->id_site, // ID du site du Vercors
            'id_uti' => auth()->id(),      // L'utilisateur connecté
        ]);

        return redirect()->back()->with('success', 'Extraction enregistrée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function transport(string $id)
    {
        $cargaison = Cargaison::findOrFail($id);
        $cargaison->statut = 'En transport';
        $cargaison->save();

        return redirect()->back()->with('success','Cargaison mise en transport.');
    }

    public function stockage(string $id)
    {
        $cargaison = Cargaison::findOrFail($id);
        $cargaison->statut = 'Stocké';
        $cargaison->save();

        return redirect()->back()->with('success','Cargaison stockée.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
