<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MouvementStockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\CargaisonController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\MineraisController;
use App\Http\Controllers\SiteController;
use App\Models\Log;
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
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'send']);

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
    Route::get('/journalisation', function () {
        $logs = Log::orderBy('created_at', 'desc')->paginate(20);
        return view('back_end.journalisation.journal', compact('logs'));
    })->name('journal');

    // Logistique & Stock
    Route::prefix('logistique')->group(function () {
        Route::get('/', fn() => view('back_end.logistique.logistique'))->name('logistique');

        // Stock
        Route::get('/stock', fn() => view('back_end.stock.stock'))->name('stock');


        Route::get('/stock/inventaire', [MaterielController::class, 'index'])->name('stock.index');


        Route::get('/stock/{id}', [MaterielController::class, 'show'])->name('materiel.show');

        Route::post('/stock/update/{id}', [MaterielController::class, 'updateStock'])->name('stock.update');
    });

    Route::prefix('mouvements')->group(function () {

        // Cargaisons
        Route::get('/cargaisons', [CargaisonController::class, 'index'])->name('cargaisons.index');
        Route::get('/cargaisons/create', [CargaisonController::class, 'create'])->name('cargaisons.create');
        Route::post('/cargaisons', [CargaisonController::class, 'store'])->name('cargaisons.store');

        // Nouvelles routes pour changer le statut
        Route::post('/cargaisons/{id}/transport', [CargaisonController::class, 'mettreEnTransport'])->name('cargaisons.transport');
        Route::post('/cargaisons/{id}/stockage', [CargaisonController::class, 'mettreEnStockage'])->name('cargaisons.stockage');

        // Transports
        Route::get('/transports', [TransportController::class, 'index'])->name('transports.index');
        Route::post('/transports', [TransportController::class, 'store'])->name('transports.store');
        Route::put('/transports/{id}', [TransportController::class, 'update'])->name('transports.update');
        Route::get('/transports/{id}', [TransportController::class, 'show'])->name('transports.show');
        Route::patch('/transports/{id}/arrive', [TransportController::class, 'arrive'])->name('transports.arrive');

        Route::get('/transports/bon/{id}', [TransportController::class, 'genererBonTransport'])->name('bons.transport');
        // Télécharger un bons de mouvement
        Route::get('/stock/bons/{id}', [MouvementStockController::class, 'show'])->name('mouvements.stock.bons');

        Route::get('/listePDF', [TransportController::class, 'listePDF'])
            ->name('logistique.liste_pdf');
    });

    // Relevés de terrain
    Route::get('/releves-terrain', fn() => view('back_end.releve_terrain.releves_terrain'))
        ->name('releves_terrain');

    // Gestion des utilisateurs
    Route::get('/utilisateur-gestion', [UserController::class, 'index'])->name('gestion_utilisateur');
    Route::post('/utilisateur', [UserController::class, 'store'])->name('users.store');
    Route::delete('/utilisateur/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::put('/utilisateur/{user}', [UserController::class, 'update'])->name('users.update');

    // Profile utilisateur
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (login, register, password, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
