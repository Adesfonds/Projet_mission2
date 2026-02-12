<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UtilisateurController extends Controller
{
    // ------------------------
    // Liste des utilisateurs (admin uniquement)
    // ------------------------
    public function gestion()
    {
        $this->authorizeAdmin();

        $utilisateurs = Utilisateur::with('role')->get();
        return view('back_end.gestion_utilisateur.gestion', compact('utilisateurs'));
    }

    // ------------------------
    // Formulaire d'ajout (admin)
    // ------------------------
    public function ajout()
    {
        $this->authorizeAdmin();

        $roles = Role::all();
        return view('back_end.gestion_utilisateur.profil_ajout', compact('roles'));
    }

    // ------------------------
    // Enregistrer un nouvel utilisateur
    // ------------------------
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'uti_nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'password' => 'required|min:5|confirmed', // confirmation password
            'role_id' => 'required|exists:roles,id',
        ]);

        Utilisateur::create([
            'uti_nom' => $request->uti_nom,
            'email' => $request->email,
            'uti_mdp' => Hash::make($request->password), // hashé
            'id_roles' => $request->role_id,
        ]);

        return redirect()->route('gestion_utilisateur')
            ->with('success', 'Utilisateur ajouté avec succès !');
    }

    // ------------------------
    // Formulaire modification
    // ------------------------
    public function edit(Utilisateur $utilisateur)
    {
        $this->authorizeAdmin();

        $roles = Role::all();
        return view('back_end.gestion_utilisateur.profil_ajout', compact('utilisateur', 'roles'));
    }

    // ------------------------
    // Mettre à jour un utilisateur
    // ------------------------
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $this->authorizeAdmin();

        $request->validate([
            'uti_nom' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('utilisateurs', 'email')->ignore($utilisateur->id),
            ],
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:5|confirmed',
        ]);

        $utilisateur->uti_nom = $request->uti_nom;
        $utilisateur->email = $request->email;
        $utilisateur->id_roles = $request->role_id;

        if ($request->filled('password')) {
            $utilisateur->uti_mdp = Hash::make($request->password);
        }

        $utilisateur->save();

        return redirect()->route('gestion_utilisateur')
            ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // ------------------------
    // Supprimer un utilisateur
    // ------------------------
    public function destroy(Utilisateur $utilisateur)
    {
        $this->authorizeAdmin();

        $utilisateur->delete();

        return redirect()->route('gestion_utilisateur')
            ->with('success', 'Utilisateur supprimé !');
    }

    // ------------------------
    // Profil utilisateur (affichage)
    // ------------------------
    public function profil(Utilisateur $utilisateur)
    {
        $roles = Role::all(); // pour Admin
        return view('back_end.gestion_utilisateur.profil', compact('utilisateur', 'roles'));
    }

    // ------------------------
    // Vérifie si l'utilisateur connecté est admin
    // ------------------------
    private function authorizeAdmin()
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès refusé.');
        }
    }
}
