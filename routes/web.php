<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;
// Page d'accueil
// ------------------------
Route::get('/', function () {
    return view('accueil');
});

// ------------------------
// Authentification
// ------------------------
// Formulaire de connexion
Route::get('/connexion', function () {
    return view('connexion');
})->name('login.form');

// Rediriger GET /login vers le formulaire
Route::get('/login', function () {
    return redirect()->route('login.form');
});

// Traiter le formulaire de connexion
Route::post('/login', [UtilisateurController::class, 'login'])->name('login');

// ------------------------
// Tableau de bord
// ------------------------
Route::get('/back_end/tableau_bord', [RoleController::class, 'tableauBord'])
    ->name('tableau_bord');



// ------------------------
// Gestion des utilisateurs
// ------------------------
Route::prefix('back_end/gestion_utilisateur')->group(function () {
    Route::get('/gestion', [UtilisateurController::class, 'gestion'])->name('gestion_utilisateur');

    // Profil d'un utilisateur (affichage simple)
    Route::get('/{utilisateur}/profil', [UtilisateurController::class, 'profil'])
        ->name('gestion_utilisateur.profil');

    // Profil avec liste des rôles (pour admin)
    Route::get('/{id}/profil', [UtilisateurController::class, 'profils'])
        ->name('profil_utilisateur');

    Route ::get('profil_ajout.php', [UtilisateurController::class, 'ajout'])->name('utilisateur_ajout');
});

// ------------------------
// Actions CRUD Utilisateurs
// ------------------------
Route::prefix('utilisateurs')->group(function () {
    Route::get('/', [UtilisateurController::class, 'index']);
    Route::get('/create', [UtilisateurController::class, 'create']);
    Route::post('/', [UtilisateurController::class, 'store'])->name('utilisateur.store');
    Route::get('/{utilisateur}', [UtilisateurController::class, 'show']);
    Route::get('/{utilisateur}/edit', [UtilisateurController::class, 'edit']);
    Route::put('/{utilisateur}', [UtilisateurController::class, 'update'])->name('utilisateur.update');
    Route::delete('/{utilisateur}', [UtilisateurController::class, 'destroy']);
    Route::delete('/utilisateurs/{utilisateur}', [UtilisateurController::class, 'delete'])
        ->name('utilisateur.delete');
});

// ------------------------
// Journalisation
// ------------------------
Route::get('/back_end/journalisation/journal', function () {
    return view('back_end.journalisation.journal');
})->name('journal');

// ------------------------
// Logistique & Stock
// ------------------------
Route::get('/back_end/logistique/logistique', function () {
    return view('back_end.logistique.logistique');
})->name('logistique');

Route::get('/back_end/stock/stock', function () {
    return view('back_end.stock.stock');
})->name('stock');

// ------------------------
// Relevés de terrain
// ------------------------
Route::get('/back_end/releves-terrain', function () {
    return view('back_end.releve_terrain.releves_terrain');
})->name('releves_terrain');

// ------------------------
// CRUD Roles
// ------------------------
Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/create', [RoleController::class, 'create']);
    Route::post('/', [RoleController::class, 'store']);
    Route::get('/{role}', [RoleController::class, 'show']);
    Route::get('/{role}/edit', [RoleController::class, 'edit']);
    Route::put('/{role}', [RoleController::class, 'update']);
    Route::delete('/{role}', [RoleController::class, 'destroy']);
});
