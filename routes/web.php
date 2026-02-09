<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;
// Page d'accueil
// ------------------------
Route::get('/', function () { return view('page_accueil'); });
// Front-end

///Présentation entreprise
///
Route::get('/entreprise', function () { return view('Front-end.presentation.entreprise'); });
Route::get('/equipe', function () { return view('Front-end.presentation.equipe'); });
Route::get('/histoire', function () { return view('Front-end.presentation.histoire'); });


//Partenariats
Route::get('/Demandes', function () { return view('Front-end.partenariats.demande_partenaire'); });
Route::get('/Partenaire', function () { return view('Front-end.partenariats.nos_partenaire'); });

//contact
Route::get('/contact', function () {return view('Front-end.contact.contact'); });

//Actualite
Route::get('/Actualites', function () {
    return view('Front-end.actualite.list_actualite');

});

//je mettrait le reste d'actualité après quand base de données Actualité sera fait

//Activité


Route::prefix('Activites')->group(function () {
    Route::get('administration', function () { return view('Front-end.activite.administration'); });
    Route::get('extraction', function () { return view('Front-end.activite.extraction'); });
    Route::get('logistique', function () { return view('Front-end.activite.logistique'); });
    Route::get('recherche', function () { return view('Front-end.activite.recherche'); });
});

//Raports environnement
Route::prefix('Rapport')->group(function () {
    Route::get('Archive', function () { return view('Front-end.rapports_enviro.archive'); });
    Route::get('Mensuels', function () { return view('Front-end.rapports_enviro.rapport_mensuels'); });
    Route::get('Trimestriel', function () { return view('Front-end.rapports_enviro.rapport_trimestriel'); });
});

// ------------------------
// Authentification
// ------------------------
// Formulaire de connexion
Route::get('/connexion', function () {
    return view('back_end.connexion');
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
