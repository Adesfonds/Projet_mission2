<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargaison;
class CargaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
