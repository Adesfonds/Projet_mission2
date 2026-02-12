<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Front-End Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', function () {
    return view('page_accueil');
});

// Présentation entreprise
Route::prefix('presentation')->group(function () {
    Route::get('/entreprise', fn() => view('Front-end.presentation.entreprise'));
    Route::get('/equipe', fn() => view('Front-end.presentation.equipe'));
    Route::get('/histoire', fn() => view('Front-end.presentation.histoire'));
});

// Partenariats
Route::prefix('partenariats')->group(function () {
    Route::get('/demandes', fn() => view('Front-end.partenariats.demande_partenaire'));
    Route::get('/nos', fn() => view('Front-end.partenariats.nos_partenaire'));
});

// Contact
Route::get('/contact', fn() => view('Front-end.contact.contact'));

// Actualités
Route::get('/actualites', fn() => view('Front-end.actualite.list_actualite'));

// Activités
Route::prefix('activites')->group(function () {
    Route::get('/administration', fn() => view('administration'));
    Route::get('/extraction', fn() => view('extraction'));
    Route::get('/logistique', fn() => view('logistique'));
    Route::get('/recherche', fn() => view('recherche'));
});

// Rapports environnement
Route::prefix('rapport')->group(function () {
    Route::get('/archive', fn() => view('archive'));
    Route::get('/mensuels', fn() => view('rapport_mensuels'));
    Route::get('/trimestriel', fn() => view('rapport_trimestriel'));
});


/*
|--------------------------------------------------------------------------
| Back-End Routes (Sécurisées)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/back_end/tableau_bord', [RoleController::class, 'tableauBord'])
        ->name('tableau_bord');

    // Journalisation
    Route::get('/back_end/journalisation/journal', fn() => view('back_end.journalisation.journal'))
        ->name('journal');

    // Logistique & Stock
    Route::get('/back_end/logistique/logistique', fn() => view('back_end.logistique.logistique'))
        ->name('logistique');

    Route::get('/back_end/stock/stock', fn() => view('back_end.stock.stock'))
        ->name('stock');

    // Relevés de terrain
    Route::get('/back_end/releves-terrain', fn() => view('back_end.releve_terrain.releves_terrain'))
        ->name('releves_terrain');

    /*
    |--------------------------------------------------------------------------
    | Gestion des utilisateurs (admin uniquement)
    |--------------------------------------------------------------------------
    */
    Route::prefix('back_end/gestion_utilisateur')->middleware(['auth', 'admin'])->group(function () {

        Route::get('/', [UtilisateurController::class, 'gestion'])->name('gestion_utilisateur');
        Route::get('/create', [UtilisateurController::class, 'ajout'])->name('utilisateur_ajout');
        Route::post('/', [UtilisateurController::class, 'store'])->name('utilisateur.store');
        Route::get('/{utilisateur}/edit', [UtilisateurController::class, 'edit'])->name('utilisateur.edit');
        Route::put('/{utilisateur}', [UtilisateurController::class, 'update'])->name('utilisateur.update');
        Route::delete('/{utilisateur}', [UtilisateurController::class, 'destroy'])->name('utilisateur.delete');
        Route::get('/{utilisateur}/profil', [UtilisateurController::class, 'profil'])->name('gestion_utilisateur.profil');
    });

    /*
    |--------------------------------------------------------------------------
    | CRUD Roles
    |--------------------------------------------------------------------------
    */
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('/create', [RoleController::class, 'create']);
        Route::post('/', [RoleController::class, 'store']);
        Route::get('/{role}', [RoleController::class, 'show']);
        Route::get('/{role}/edit', [RoleController::class, 'edit']);
        Route::put('/{role}', [RoleController::class, 'update']);
        Route::delete('/{role}', [RoleController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | Profile utilisateur (auth)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
|
| Breeze gère toutes les routes : login, register, logout, reset-password, etc.
|
*/
require __DIR__.'/auth.php';
