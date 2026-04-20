<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Capteur;
use Illuminate\Http\Request;

class CapteurController extends Controller
{
    // GET /api/capteurs
    public function index()
    {
        return response()->json(
            Capteur::all()
        );
    }

    // GET /api/capteurs/{id}
    public function show($id)
    {
        $capteur = Capteur::find($id);

        if (!$capteur) {
            return response()->json([
                'message' => 'Capteur introuvable'
            ], 404);
        }

        return response()->json($capteur);
    }

    // POST /api/capteurs
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_capt' => 'required|string',
                'type_capteur' => 'required|string',
                'modele_' => 'nullable|string',
                'fabricant' => 'nullable|string',
                'localisation' => 'nullable|string',
                'unite_mesure' => 'nullable|string',
                'date_mise_service_' => 'nullable|string',
                'seuil_min' => 'nullable|numeric',
                'seuil_max' => 'nullable|numeric',
            ]);

            $capteur = Capteur::create($data);

            return response()->json([
                'message' => 'Capteur créé avec succès',
                'data' => $capteur
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la création du capteur',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // PUT /api/capteurs/{id}
    public function update(Request $request, $id)
    {
        $capteur = Capteur::find($id);

        if (!$capteur) {
            return response()->json([
                'message' => 'Capteur introuvable'
            ], 404);
        }

        $capteur->update($request->all());

        return response()->json([
            'message' => 'Capteur mis à jour',
            'data' => $capteur
        ]);
    }

    // DELETE /api/capteurs/{id}
    public function destroy($id)
    {
        $capteur = Capteur::find($id);

        if (!$capteur) {
            return response()->json([
                'message' => 'Capteur introuvable'
            ], 404);
        }

        $capteur->delete();

        return response()->json([
            'message' => 'Capteur supprimé'
        ]);
    }
}
