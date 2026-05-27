# Middleware Laravel — RoleMiddleware

---

## 1. Présentation

Ce middleware permet de contrôler l’accès aux routes en fonction du rôle de l’utilisateur connecté.

Il vérifie deux conditions :

- L’utilisateur doit être authentifié
- Son rôle doit être autorisé

---

## 2. Fonctionnement

### Étape 1 : Vérification de l’authentification

```php
if (!auth()->check()) {
    abort(403);
}
```

Si l’utilisateur n’est pas connecté, l’accès est refusé (code 403).

---

### Étape 2 : Vérification du rôle

```php
if (!in_array(auth()->user()->id_roles, $roles)) {
    abort(403);
}
```

Le rôle de l’utilisateur est comparé à la liste des rôles autorisés.

---

### Étape 3 : Autorisation

```php
return $next($request);
```

Si tout est correct, la requête continue normalement.

---

## 3. Utilisation dans les routes

```php
Route::get('/admin', function () {
    return view('admin');
})->middleware('role:1,2');
```

---

# 4. Gestion des rôles et des permissions

---

## 4.1 Présentation

Le système de rôles permet de contrôler précisément les accès aux différentes fonctionnalités de l’application.

Chaque utilisateur possède un rôle (`id_roles`) qui détermine ses droits.

---

## 4.2 Liste des rôles et accès

---

### Administrateur

Profil ayant tous les droits sur l’application.

Accès :

- Gestion des utilisateurs
- Logistique
- Stock
- Journalisation
- Relevés de terrain

---

### Direction

Responsable stratégique de l’entreprise.

Accès :

- Gestion des utilisateurs
- Logistique
- Stock
- Journalisation
- Relevés de terrain

---

### Chef de site

Responsable opérationnel du site.

Accès :

- Logistique
- Stock
- Relevés de terrain

---

### Technicien

Responsable du suivi technique et des données.

Accès :

- Relevés de terrain
- Journalisation

---

### Service logistique (Logisticien)

Gestion du matériel et des flux logistiques.

Accès :

- Logistique
- Stock

---

### Chercheur

Analyse et exploitation des données scientifiques.

Accès :

- Relevés de terrain

---

### Partenaire externe

Accès limité aux données scientifiques partagées.

Accès :

- Relevés de terrain

---

### Transporteur

Responsable du transport des cargaisons.

Accès :

- Logistique

---

## 4.3 Conclusion

Ce système de rôles permet une gestion sécurisée et structurée de l’application.

Il garantit :

- une séparation claire des responsabilités
- une sécurité renforcée via le middleware
- une organisation adaptée à un système professionnel Laravel

---

## 5. Conclusion générale du middleware

Ce middleware RoleMiddleware est un élément central de la sécurité de l’application.

Il permet de protéger les routes et de contrôler précisément les accès selon les profils utilisateurs.
