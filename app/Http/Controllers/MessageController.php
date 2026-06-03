<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private array $motsInterdits = [
        'raciste',
        'haine',
        'insulte'
    ];

    public function index()
    {
        return Message::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
            'actu_id' => 'required|exists:activities,id'
        ]);

        if ($this->contientMotInterdit($request->contenu)) {
            return response()->json([
                'status'  => false,
                'message' => 'Message refusé (contenu inapproprié)'
            ], 422);
        }

        $message = Message::create([
            'message' => $request->contenu,  // ← corrigé
            'actu_id' => $request->actu_id
        ]);
        return redirect()->route('actualites.show', $message->actu_id);
    }

    public function show(Message $message)
    {
        return $message;
    }

    public function verifierMessage(Message $message)
    {
        if ($this->contientMotInterdit($message->message)) {
            $message->delete();
            return response()->json([
                'status'  => false,
                'message' => 'Message supprimé (contenu inapproprié)'
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Message accepté'
        ]);
    }

    private function contientMotInterdit(string $contenu): bool
    {
        $contenuMin = strtolower($contenu);
        foreach ($this->motsInterdits as $mot) {
            if (str_contains($contenuMin, $mot)) {
                return true;
            }
        }
        return false;
    }
}
