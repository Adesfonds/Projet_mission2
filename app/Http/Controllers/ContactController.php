<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('Front-end.contact.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nom'     => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'contenu' => 'required|string', // ← renommé
        ]);

        Mail::send(
            'emails.contact',
            $request->only('nom', 'email', 'subject', 'contenu'), // ← 'message' renommé en 'contenu'
            function ($message) use ($request) {
                $message->to('vem2026@outlook.fr')
                    ->replyTo($request->email, $request->nom)
                    ->subject('Contact VEM : ' . $request->subject);
            }
        );

        return back()->with('success', 'Merci pour votre message !');
    }
}
