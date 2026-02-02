<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilisateurController extends Controller
{
    // ------------------------
    // Authentification
    // ------------------------
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Recherche de l'utilisateur par email et mot de passe en clair
        $user = DB::table('utilisateur')
            ->where('email', $request->email)
            ->where('uti_mdp', $request->password)
            ->first();

        if ($user) {
            session(['utilisateur' => $user]);
            return redirect()->route('tableau_bord');
        }

        return back()->withErrors([
            'email' => 'Adresse mail ou mot de passe incorrect',
        ]);
    }

    // ------------------------
    // Liste des utilisateurs
    // ------------------------
    public function gestion()
    {
        $utilisateurs = Utilisateur::with('role')->get();
        return view('back_end.gestion_utilisateur.gestion', compact('utilisateurs'));
    }

    // ------------------------
    // Formulaire d'ajout
    // ------------------------
    public function ajout()
    {
        $roles = Role::all();
        return view('back_end.gestion_utilisateur.profil_ajout', compact('roles'));
    }

    // ------------------------
    // Enregistrer un nouvel utilisateur
    // ------------------------
    public function store(Request $request)
    {
        $request->validate([
            'uti_nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateur,email',
            'password' => 'required|min:5',
            'role_id' => 'required|exists:role,id_role'
        ]);

        Utilisateur::create([
            'uti_nom' => $request->uti_nom,
            'email' => $request->email,
            'uti_mdp' => $request->password, // mot de passe en clair
            'id_roles' => $request->role_id
        ]);

        return redirect()->route('gestion_utilisateur')->with('success', 'Utilisateur ajouté avec succès !');
    }

    // ------------------------
    // Formulaire modification
    // ------------------------
    public function edit(Utilisateur $utilisateur)
    {
        $roles = Role::all();
        return view('back_end.gestion_utilisateur.profil_ajout', compact('utilisateur', 'roles'));
    }

    // ------------------------
    // Mettre à jour un utilisateur
    // ------------------------
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $sessionUser = session('utilisateur');
        $sessionUserModel = Utilisateur::with('role')->find($sessionUser->id_uti ?? 0);

        // Vérifier que l'utilisateur connecté est admin
        if (!$sessionUserModel || $sessionUserModel->role->libelle !== 'Admin') {
            return redirect()->back()->with('error', 'Vous n’avez pas la permission de modifier ce rôle.');
        }

        $request->validate([
            'uti_nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateur,email,' . $utilisateur->id_uti . ',id_uti',
            'role_id' => 'required|exists:role,id_role',
        ]);

        $utilisateur->uti_nom = $request->uti_nom;
        $utilisateur->email = $request->email;
        $utilisateur->id_roles = $request->role_id;

        // Mise à jour du mot de passe uniquement si rempli
        if ($request->filled('password')) {
            $utilisateur->uti_mdp = $request->password; // mot de passe en clair
        }

        $utilisateur->save();

        return redirect()->route('gestion_utilisateur')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // ------------------------
    // Supprimer un utilisateur
    // ------------------------
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return redirect()->route('gestion_utilisateur')->with('success', 'Utilisateur supprimé !');
    }

    // ------------------------
    // Profil utilisateur (affichage)
    // ------------------------
    public function profil(Utilisateur $utilisateur)
    {
        $roles = Role::all(); // pour Admin
        return view('back_end.gestion_utilisateur.profil', compact('utilisateur', 'roles'));
    }

}
