# 7. Base de données — Projet VEM (Laravel / PostgreSQL)

---

## 7.1 Présentation générale

La base de données du projet VEM est conçue sous PostgreSQL.

Elle permet de gérer :

- les utilisateurs et rôles
- les capteurs et mesures
- la logistique (stock, matériel, commandes)
- les transports et cargaisons
- les activités et rapports
- les logs système

L’ensemble du système repose sur des relations entre tables avec des clés primaires et étrangères.

---

## 7.2 Gestion des utilisateurs et sécurité

---

### Table `roles`

Permet de définir les rôles utilisateurs.

- `id_role` (PK)
- `libelle_`

---

### Table `users`

Contient les utilisateurs de l’application.

Relations :

- `id_roles` → roles(id_role)

---

### Table `logs`

Journalise les actions utilisateurs.

Relations :

- `id_uti` → users(id)

---

## 7.3 Authentification Laravel

Tables système :

- `sessions`
- `password_reset_tokens`
- `cache`
- `cache_locks`
- `jobs`
- `failed_jobs`
- `job_batches`
- `migrations`

Ces tables sont gérées automatiquement par Laravel.

---

## 7.4 Module Capteurs / Mesures (API scientifique)

---

### Table `capteur_`

Stocke les capteurs :

- id_capt (PK)
- type_capteur
- modele_
- fabricant
- localisation
- unite_mesure
- date_mise_service_
- seuil_min
- seuil_max

---

### Table `mesure_`

Stocke les mesures :

- id_mesure_ (PK)
- horodatage
- valeur
- unite

---

### Table `collecte_`

Table de liaison (many-to-many) :

- id_capt (FK → capteur_)
- id_mesure_ (FK → mesure_)

Clé primaire composée :
- (id_capt, id_mesure_)

---

## 7.5 Module logistique

---

### Table `materiel`

Gestion du stock :

- id_materiel
- nom
- description
- stock
- seuil_alerte

---

### Table `mouvement_stock`

Historique des mouvements :

- entrée
- sortie
- utilisateur
- matériel

Relations :

- id_uti → users
- id_materiel → materiel

---

### Table `commande`

Gestion des commandes fournisseurs.

Relation :

- id_fournisseur → fournisseur

---

### Table `contenir`

Table pivot :

- commande ↔ matériel

---

### Table `fournisseur`

Gestion des fournisseurs.

---

## 7.6 Module transport / extraction

---

### Table `transport`

- date_depart
- date_arrivee
- destination
- statut_transport

---

### Table `cargaison`

Lien entre :

- transport
- site
- utilisateur
- minerais

---

### Table `sites`

Localisation des sites d’extraction.

---

### Table `minerais`

Types de minerais exploités.

---

## 7.7 Module activité / rapports

---

### Table `activities`

Contient les actualités de l’entreprise.

---

### Table `rapports`

Contient les rapports :

- mensuels
- trimestriels

Contraintes :

- type limité à (`mensuel`, `trimestriel`)

---

## 7.8 Architecture relationnelle (résumé)

Le système repose sur 4 grands blocs :

- Authentification (users, roles, logs)
- API scientifique (capteurs, mesures, collecte)
- Logistique (stock, commandes, matériel)
- Extraction (transport, cargaison, minerais, sites)

---

## 7.9 Conclusion

La base de données du projet VEM est structurée de manière relationnelle afin de :

- garantir la cohérence des données
- faciliter les requêtes API Laravel
- assurer la traçabilité des actions
- séparer les modules fonctionnels

Elle constitue le cœur du système global entre la mission de collecte et l’exploitation des données via l’API REST.
