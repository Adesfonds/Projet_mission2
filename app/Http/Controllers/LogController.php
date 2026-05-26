<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Afficher la liste des logs
     */
    public function index(Request $request)
    {
        $logs = Log::with('user')
            ->when($request->search, function ($query, $search) {
                $query->where('action', 'like', "%{$search}%")
                    ->orWhere('ip_adresse', 'like', "%{$search}%")
                    ->orWhereHas('user', fn($q) =>
                    $q->where('email', 'like', "%{$search}%")
                    );
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('back_end.journalisation.journal', compact('logs'));
    }
}
