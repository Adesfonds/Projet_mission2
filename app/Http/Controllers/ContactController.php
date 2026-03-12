<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Afficher le formulaire
    public function index()
    {
        return view('Front-end.contact.contact');
    }

    // Traiter le formulaire
    public function send(Request $request)
    {
        // Validation
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Optionnel : envoyer un email
        /*
        Mail::send('emails.contact', $request->all(), function($message) use ($request){
            $message->to('tonemail@example.com')
                    ->subject($request->subject);
        });
        */

        return back()->with('success', 'Merci pour votre message !');
    }
}
