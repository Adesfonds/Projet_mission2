<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONT-END ROUTES
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', fn() => view('page_accueil'));

// Dashboard (Front-end)
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Présentation de l'entreprise
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
    Route::get('/administration', fn() => view('activites.administration'));
    Route::get('/extraction', fn() => view('activites.extraction'));
    Route::get('/logistique', fn() => view('activites.logistique'));
    Route::get('/recherche', fn() => view('activites.recherche'));
});

// Rapports environnementaux
Route::prefix('rapport')->group(function () {
    Route::get('/archive', fn() => view('rapports.archive'));
    Route::get('/mensuels', fn() => view('rapports.rapport_mensuels'));
    Route::get('/trimestriel', fn() => view('rapports.rapport_trimestriel'));
});

/*
|--------------------------------------------------------------------------
| BACK-END ROUTES (auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {


    // Journalisation
    Route::get('/journalisation', fn() => view('back_end.journalisation.journal'))
        ->name('journal');

    // Logistique & Stock
    Route::get('/logistique', fn() => view('back_end.logistique.logistique'))
        ->name('logistique');

    Route::get('/stock', fn() => view('back_end.stock.stock'))
        ->name('stock');

    // Relevés de terrain
    Route::get('/releves-terrain', fn() => view('back_end.releve_terrain.releves_terrain'))
        ->name('releves_terrain');

    Route::get('/utilisateur-gestion', fn() => view('back_end.gestion_utilisateur.gestion'))
        ->name('gestion_utilisateur');



    // Profile utilisateur
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Auth routes (login, register, password, etc.)
require __DIR__.'/auth.php';
