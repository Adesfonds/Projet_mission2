# API REST Laravel — Gestion des capteurs et mesures

---

# 1. Présentation générale

L’application repose sur une API REST développée avec le framework **Laravel**, permettant de gérer les données issues de capteurs environnementaux et des mesures associées.

L’API expose les données au format **JSON**, facilitant la communication entre plusieurs applications.

---

## Technologies utilisées

- PHP
- Laravel
- Eloquent ORM
- API REST
- JSON

---

## Avantages de l’architecture

- Séparation frontend / backend
- Réutilisation des données
- Maintenance facilitée
- Communication standardisée

---

# 2. Lien avec la mission 1

La mission 1 consistait à simuler la collecte de données scientifiques issues de capteurs installés sur un site pilote d’extraction du Vercorium dans le massif du Vercors.

Une application Java avec JavaFX permettait :

- la génération de données de capteurs
- l’enregistrement local des mesures
- la gestion des métadonnées des capteurs
- le stockage des données dans une base PostgreSQL après transfert

---

## Limite de la mission 1

Une contrainte importante était l’instabilité du réseau 4G sur le site, empêchant l’envoi permanent des données vers un serveur distant.

---

## Évolution vers l’API REST

La seconde mission fait évoluer ce système vers une architecture moderne basée sur une API REST développée avec Laravel.

Cette évolution permet :

- la centralisation des données
- l’accès distant aux informations
- l’échange de données au format JSON
- la communication entre plusieurs applications

---

## Données concernées

L’API reprend les éléments de la mission 1 :

- capteurs
- mesures
- collectes

---

## Méthodes HTTP utilisées

- GET
- POST
- PUT
- DELETE

---

## Conclusion de la transition

La mission 2 représente la continuité logique du projet :

- Mission 1 → collecte et stockage local des données
- Mission 2 → exploitation via une API REST centralisée

---

# 3. Architecture de l’API REST

---

## Contrôleurs principaux

- `CapteurController`
- `MesureController`
- `CollecteController`

---

## Rôle global

Ces contrôleurs permettent d’effectuer les opérations CRUD :

- Create (Créer)
- Read (Lire)
- Update (Modifier)
- Delete (Supprimer)

---

# 4. Routes API

---

## 4.1 CAPTEURS

```php
Route::get('/capteurs', [CapteurController::class, 'index']);
Route::get('/capteurs/{id}', [CapteurController::class, 'show']);
Route::post('/capteurs', [CapteurController::class, 'store']);
Route::put('/capteurs/{id}', [CapteurController::class, 'update']);
Route::delete('/capteurs/{id}', [CapteurController::class, 'destroy']);
```

---

## 4.2 MESURES

```php
Route::get('/mesures', [MesureController::class, 'index']);
Route::get('/mesures/{id}', [MesureController::class, 'show']);
Route::post('/mesures', [MesureController::class, 'store']);
Route::put('/mesures/{id}', [MesureController::class, 'update']);
Route::delete('/mesures/{id}', [MesureController::class, 'destroy']);
```

---

## 4.3 COLLECTE

```php
Route::get('/collecte', [CollecteController::class, 'index']);
Route::post('/collecte', [CollecteController::class, 'store']);
Route::delete('/collecte/{id_capt}/{id_mesure}', [CollecteController::class, 'destroy']);
```

---

## 4.4 ROUTES COMPLÉMENTAIRES

```php
Route::get('/mesures/capteur/{id_capt}', [MesureController::class, 'byCapteur']);

Route::get('/ping', function () {
    return response()->json(['ok' => true]);
});
```

---

# 5. CapteurController

---

## Rôle

Gestion des capteurs du système.

## Routes API

| Méthode | Route | Description |
|--------|------|-------------|
| GET | `/api/capteurs` | Liste tous les capteurs |
| GET | `/api/capteurs/{id}` | Affiche un capteur |
| POST | `/api/capteurs` | Crée un capteur |
| PUT | `/api/capteurs/{id}` | Met à jour un capteur |
| DELETE | `/api/capteurs/{id}` | Supprime un capteur |

---

## Points techniques

- Validation des données avec `request->validate()`
- Réponses JSON standardisées
- Gestion des erreurs HTTP
- Utilisation du modèle Eloquent `Capteur`

---

# 6. MesureController

---

## Rôle

Gestion des mesures collectées par les capteurs.

## Fonctionnalités

- `index()` → liste des mesures
- `show()` → affiche une mesure
- `store()` → crée une mesure
- `update()` → met à jour une mesure
- `destroy()` → supprime une mesure
- `byCapteur()` → filtre les mesures par capteur

---

## Exemple

```php
Collecte::with('mesure')
    ->where('id_capt', $id_capt)
    ->get()
    ->pluck('mesure');
```

---

# 7. CollecteController

---

## Rôle

Gestion de la relation entre capteurs et mesures.

---

## Structure

Table de liaison :

- `id_capt`
- `id_mesure_`

---

## Exemple

```php
Collecte::where('id_capt', $id_capt)
    ->where('id_mesure_', $id_mesure)
    ->first();
```

---

# 8. Exemple de réponse JSON

```json
{
    "message": "Capteur créé avec succès",
    "data": {
        "id_capt": "CAPT01",
        "type_capteur": "Température"
    }
}
```
