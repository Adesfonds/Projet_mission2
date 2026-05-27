# Routes Laravel — Application VEM

---

# 1. Présentation générale

Ce fichier contient l’ensemble des routes de l’application Laravel VEM.

Il est divisé en deux grandes parties :

- Front-end (public)
- Back-end (sécurisé par authentification et rôles)

---

# 2. Front-end (public)

## Page d’accueil

```php
Route::get('/', fn() => view('page_accueil'));
```

---

## Dashboard

```php
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
```

---

## Présentation de l’entreprise

```php
Route::prefix('presentation')->group(function () {
    Route::get('/entreprise', fn() => view('Front-end.presentation.entreprise'));
    Route::get('/equipe', fn() => view('Front-end.presentation.equipe'));
    Route::get('/histoire', fn() => view('Front-end.presentation.histoire'));
});
```

---

## Partenariats

```php
Route::prefix('partenariats')->group(function () {
    Route::get('/demandes', fn() => view('Front-end.partenariats.demande_partenaire'));
    Route::get('/nos', fn() => view('Front-end.partenariats.nos_partenaire'));
});
```

---

## Contact

```php
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'send']);
```

---

## Actualités

```php
Route::prefix('actualites')->name('actualites.')->group(function () {
    Route::get('/', [ActivityController::class, 'index'])->name('index');
    Route::get('/{activity}', [ActivityController::class, 'show'])->name('show');
});
```

---

## Activités

```php
Route::prefix('activites')->group(function () {
    Route::get('/administration', fn() => view('activites.administration'));
    Route::get('/extraction', fn() => view('activites.extraction'));
    Route::get('/logistique', fn() => view('activites.logistique'));
    Route::get('/recherche', fn() => view('activites.recherche'));
});
```

---

## Rapports

```php
Route::prefix('rapports')->name('rapports.')->group(function () {
    Route::get('/mensuel', [RapportController::class, 'mensuel'])->name('mensuel');
    Route::get('/trimestriel', [RapportController::class, 'trimestriel'])->name('trimestriel');
    Route::get('/archive', [RapportController::class, 'archive'])->name('archive');
    Route::get('/{rapport}', [RapportController::class, 'show'])->name('show');
});
```

---

# 3. Back-end (sécurisé)

Toutes les routes ci-dessous nécessitent une authentification :

```php
Route::middleware(['auth'])->group(function () {
```

---

# 4. Journalisation

```php
Route::middleware(['role:1,2,4'])->group(function () {
    Route::get('/journalisation', function () {
        $logs = Log::orderBy('created_at', 'desc')->paginate(20);
        return view('back_end.journalisation.journal', compact('logs'));
    })->name('journal');
});
```

---

# 5. Logistique & Stock

```php
Route::middleware(['role:1,2,3,5,8'])
    ->prefix('logistique')
    ->group(function () {
```

Fonctionnalités :

- Stock
- Inventaire matériel
- Mouvements de stock

---

# 6. Commandes

```php
Route::middleware(['role:1,2,3,5,8'])
    ->prefix('commandes')
    ->group(function () {
```

Fonctionnalités :

- Liste des commandes
- Création
- Mise à jour

---

# 7. Mouvements & Transport

```php
Route::middleware(['role:1,2,3,5,8'])
    ->prefix('mouvements')
    ->group(function () {
```

Fonctionnalités :

- Cargaisons
- Transports
- Stockage
- Génération de bons PDF

---

# 8. Relevés terrain (capteurs & mesures)

```php
Route::middleware(['role:1,2,3,4,5,6,7'])->group(function () {
```

Fonctionnalités :

- Capteurs
- Mesures
- Collectes
- Relevés terrain

---

# 9. Gestion utilisateurs

```php
Route::middleware(['role:1,2'])->group(function () {
```

Fonctionnalités :

- Création utilisateur
- Modification
- Suppression

---

# 10. Profil utilisateur

```php
Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
```

---

# 11. Authentification

```php
require __DIR__.'/auth.php';
```

---

# 12. Conclusion

Ce système de routes permet :

- Une séparation claire front-end / back-end
- Une sécurité basée sur les rôles
- Une organisation modulaire des fonctionnalités
- Une architecture adaptée à une application professionnelle Laravel
