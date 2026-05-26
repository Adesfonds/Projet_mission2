<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CapteurController;
use App\Http\Controllers\CollecteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MesureController;
use App\Http\Controllers\MouvementStockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ReleveTerrainController;
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

Route::prefix('actualites')->name('actualites.')->group(function () {
    Route::get('/', [ActivityController::class, 'index'])->name('index');
    Route::get('/{activity}', [ActivityController::class, 'show'])->name('show');
});

// Activités
Route::prefix('activites')->group(function () {
    Route::get('/administration', fn() => view('activites.administration'));
    Route::get('/extraction', fn() => view('activites.extraction'));
    Route::get('/logistique', fn() => view('activites.logistique'));
    Route::get('/recherche', fn() => view('activites.recherche'));
});

Route::prefix('rapports')->name('rapports.')->group(function () {

    Route::get('/mensuel', [RapportController::class, 'mensuel'])
        ->name('mensuel');

    Route::get('/trimestriel', [RapportController::class, 'trimestriel'])
        ->name('trimestriel');

    Route::get('/archive', [RapportController::class, 'archive'])
        ->name('archive');
    Route::get('/{rapport}', [RapportController::class, 'show'])
        ->name('show');
});
/*
|--------------------------------------------------------------------------
| BACK-END ROUTES (SECURISÉES PAR RÔLES)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |---------------------------
    | JOURNALISATION (1,2,4)
    |---------------------------
    */
    Route::middleware(['role:1,2,4'])->group(function () {
        Route::get('/journalisation', function () {
            $logs = Log::orderBy('created_at', 'desc')->paginate(20);
            return view('back_end.journalisation.journal', compact('logs'));
        })->name('journal');
    });

    /*
    |---------------------------
    | LOGISTIQUE / STOCK (1,2,3,5,8)
    |---------------------------
    */
    Route::middleware(['role:1,2,3,5,8'])->prefix('logistique')->group(function () {

        Route::get('/', fn() => view('back_end.logistique.logistique'))->name('logistique');
        Route::get('/stock', fn() => view('back_end.stock.stock'))->name('stock');

        Route::get('/stock/inventaire', [MaterielController::class, 'index'])->name('stock.index');
        Route::get('/stock/create', [MaterielController::class, 'create'])->name('stock.create');
        Route::post('/stock/store', [MaterielController::class, 'store'])->name('stock.store');
        Route::get('/stock/{id}', [MaterielController::class, 'show'])->name('stock.show');
        Route::put('/stock/{id}', [MaterielController::class, 'update'])->name('stock.update');
        Route::delete('/stock/{id}', [MaterielController::class, 'delete'])->name('stock.delete');

        Route::get('/mouvements', [MouvementStockController::class, 'index'])->name('mouvements.index');
        Route::post('/stock/{id}/entree', [MouvementStockController::class, 'entree'])->name('stock.entree');
        Route::post('/stock/{id}/sortie', [MouvementStockController::class, 'sortie'])->name('stock.sortie');
    });

    /*
    |---------------------------
    | COMMANDES (1,2,3,5,8)
    |---------------------------
    */
    Route::middleware(['role:1,2,3,5,8'])->prefix('commandes')->group(function () {

        Route::get('/', [CommandeController::class, 'index'])->name('commandes.index');
        Route::get('/create', [CommandeController::class, 'create'])->name('commandes.create');
        Route::post('/', [CommandeController::class, 'store'])->name('commandes.store');
        Route::put('/{id}', [CommandeController::class, 'update'])->name('commandes.update');
    });

    /*
    |---------------------------
    | MOUVEMENTS (1,2,3,5,8)
    |---------------------------
    */
    Route::middleware(['role:1,2,3,5,8'])->prefix('mouvements')->group(function () {

        Route::get('/cargaisons', [CargaisonController::class, 'index'])->name('cargaisons.index');
        Route::get('/cargaisons/create', [CargaisonController::class, 'create'])->name('cargaisons.create');
        Route::post('/cargaisons', [CargaisonController::class, 'store'])->name('cargaisons.store');

        Route::post('/cargaisons/{id}/transport', [CargaisonController::class, 'mettreEnTransport'])->name('cargaisons.transport');
        Route::post('/cargaisons/{id}/stockage', [CargaisonController::class, 'mettreEnStockage'])->name('cargaisons.stockage');

        Route::get('/transports', [TransportController::class, 'index'])->name('transports.index');
        Route::post('/transports', [TransportController::class, 'store'])->name('transports.store');
        Route::put('/transports/{id}', [TransportController::class, 'update'])->name('transports.update');
        Route::get('/transports/{id}', [TransportController::class, 'show'])->name('transports.show');
        Route::patch('/transports/{id}/arrive', [TransportController::class, 'arrive'])->name('transports.arrive');

        Route::get('/transports/bon/{id}', [TransportController::class, 'genererBonTransport'])->name('bons.transport');

        Route::get('/stock/bons/{id}', [MouvementStockController::class, 'show'])->name('mouvements.stock.bons');

        Route::get('/listePDF', [TransportController::class, 'listePDF'])->name('logistique.liste_pdf');
    });

    /*
    |---------------------------
    | RELEVÉS TERRAIN (1-7)
    |---------------------------
    */
    Route::middleware(['role:1,2,3,4,5,6,7'])->group(function () {

        Route::get('/capteurs', [CapteurController::class, 'index'])->name('capteurs.index');
        Route::get('/capteurs/{id}', [CapteurController::class, 'show'])->name('capteurs.show');

        Route::get('/mesures', [MesureController::class, 'index'])->name('mesures.index');
        Route::get('/mesures/{id}', [MesureController::class, 'show'])->name('mesures.show');

        Route::get('/collectes', [CollecteController::class, 'index'])->name('collectes.index');
        Route::get('/collectes/{id_capt}/{id_mesure_}', [CollecteController::class, 'show'])->name('collectes.show');

        Route::get('/releves-terrain', [ReleveTerrainController::class, 'index'])->name('releves_terrain');
    });

    /*
    |---------------------------
    | UTILISATEURS (1,2)
    |---------------------------
    */
    Route::middleware(['role:1,2'])->group(function () {

        Route::get('/utilisateur-gestion', [UserController::class, 'index'])->name('gestion_utilisateur');
        Route::post('/utilisateur', [UserController::class, 'store'])->name('users.store');
        Route::delete('/utilisateur/{id}', [UserController::class, 'delete'])->name('users.delete');
        Route::put('/utilisateur/{user}', [UserController::class, 'update'])->name('users.update');
    });

    /*
    |---------------------------
    | PROFILE (tous utilisateurs)
    |---------------------------
    */
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
