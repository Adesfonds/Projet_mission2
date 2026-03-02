<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Afficher la liste des logs
     */
    public function index()
    {
        $logs = Log::orderBy('created_at', 'desc')->paginate(20);

        return view('back_end.journalisation.journal', compact('logs'));
    }
}
