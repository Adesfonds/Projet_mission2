<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role_id' => 'required|exists:roles,id_role'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_roles' => $request->role_id
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
    public function update(Request $request, User $user)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role_id' => 'required|exists:roles,id_role',
            'password' => 'nullable|min:5|confirmed',
        ]);


        // Mise à jour des champs
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_roles = $request->role_id;

        // Si mot de passe rempli → on le met à jour
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();



        return redirect()->route('gestion_utilisateur')
            ->with('success', 'Utilisateur mis à jour avec succès !');

    }
}
