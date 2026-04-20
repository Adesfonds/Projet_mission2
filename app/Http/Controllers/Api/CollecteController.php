<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collecte;
use Illuminate\Http\Request;

class CollecteController extends Controller
{
    // GET /api/collecte
    public function index()
    {
        return response()->json(
            Collecte::with(['capteur', 'mesure'])->get()
        );
    }

    // GET /api/collecte/{id} (ATTENTION clé composée)
    public function show($id_capt, $id_mesure)
    {
        $collecte = Collecte::where('id_capt', $id_capt)
            ->where('id_mesure_', $id_mesure)
            ->first();

        if (!$collecte) {
            return response()->json([
                'message' => 'Collecte introuvable'
            ], 404);
        }

        return response()->json($collecte);
    }

    // POST /api/collecte
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_capt' => 'required|string',
                'id_mesure_' => 'required|string',
            ]);

            $collecte = Collecte::create($data);

            return response()->json([
                'message' => 'Collecte créée avec succès',
                'data' => $collecte
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Erreur lors de la création de la collecte',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // DELETE /api/collecte/{id}
    public function destroy($id_capt, $id_mesure)
    {
        $collecte = Collecte::where('id_capt', $id_capt)
            ->where('id_mesure_', $id_mesure)
            ->first();

        if (!$collecte) {
            return response()->json([
                'message' => 'Collecte introuvable'
            ], 404);
        }

        $collecte->delete();

        return response()->json([
            'message' => 'Collecte supprimée'
        ]);
    }
}
