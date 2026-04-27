<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collecte;
use App\Models\Mesure;
use Illuminate\Http\Request;

class MesureController extends Controller
{
    // GET /api/mesures
    public function index()
    {
        return response()->json(
            Mesure::all()
        );
    }

    // GET /api/mesures/{id}
    public function show($id)
    {
        $mesure = Mesure::find($id);

        if (!$mesure) {
            return response()->json([
                'message' => 'Mesure introuvable'
            ], 404);
        }

        return response()->json($mesure);
    }

    // POST /api/mesures
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_mesure_' => 'required|string',
                'horodatage' => 'required|string',
                'valeur' => 'required|numeric',
                'unite' => 'nullable|string',
            ]);

            $mesure = Mesure::create($data);

            return response()->json([
                'message' => 'Mesure créée avec succès',
                'data' => $mesure
            ], 201);

        } catch (\Exception $exception) {

            return response()->json([
                'message' => 'Erreur lors de la création',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    // PUT /api/mesures/{id}
    public function update(Request $request, $id)
    {
        $mesure = Mesure::find($id);

        if (!$mesure) {
            return response()->json([
                'message' => 'Mesure introuvable'
            ], 404);
        }

        $mesure->update($request->all());

        return response()->json([
            'message' => 'Mesure mise à jour',
            'data' => $mesure
        ]);
    }

    // DELETE /api/mesures/{id}
    public function destroy($id)
    {
        $mesure = Mesure::find($id);

        if (!$mesure) {
            return response()->json([
                'message' => 'Mesure introuvable'
            ], 404);
        }

        $mesure->delete();

        return response()->json([
            'message' => 'Mesure supprimée'
        ]);
    }
    public function byCapteur($id_capt)
    {
        return response()->json(
            Collecte::with('mesure')
                ->where('id_capt', $id_capt)
                ->get()
                ->pluck('mesure')
        );
    }
}
