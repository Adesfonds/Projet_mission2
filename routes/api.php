<?php
use App\Http\Controllers\Api\CapteurController;
use App\Http\Controllers\Api\MesureController;
use App\Http\Controllers\Api\CollecteController;
use Illuminate\Support\Facades\Route;

// CAPTEURS
Route::get('/capteurs', [CapteurController::class, 'index']);
Route::get('/capteurs/{id}', [CapteurController::class, 'show']);
Route::post('/capteurs', [CapteurController::class, 'store']);
Route::put('/capteurs/{id}', [CapteurController::class, 'update']);
Route::delete('/capteurs/{id}', [CapteurController::class, 'destroy']);

// MESURES
Route::get('/mesures', [MesureController::class, 'index']);
Route::get('/mesures/{id}', [MesureController::class, 'show']);
Route::post('/mesures', [MesureController::class, 'store']);
Route::put('/mesures/{id}', [MesureController::class, 'update']);
Route::delete('/mesures/{id}', [MesureController::class, 'destroy']);

// COLLECTE
Route::get('/collecte', [CollecteController::class, 'index']);
Route::post('/collecte', [CollecteController::class, 'store']);
Route::delete('/collecte/{id_capt}/{id_mesure}', [CollecteController::class, 'destroy']);

Route::get('/ping', function () {
    return response()->json(['ok' => true]);
});
