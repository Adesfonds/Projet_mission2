<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = \App\Models\Role::all(); // IMPORTANT pour ton select

        return view('back_end.gestion_utilisateur.gestion', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role_id' => 'required'
        ]);

        // Création utilisateur
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        return redirect()->route('gestion_utilisateur')
            ->with('success', 'Utilisateur ajouté avec succès');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'Utilisateur supprimé');
    }
}
