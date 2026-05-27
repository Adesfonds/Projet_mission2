# Contrôleurs Laravel — Architecture du projet

---

## 1. Contrôleurs d’authentification & profil

### Auth (Laravel Breeze / Auth system)
Gère :
- inscription
- connexion
- mot de passe
- vérification email
- déconnexion

Fichiers :
```
App\Http\Controllers\Auth\
```

---

### ProfileController
Gestion du profil utilisateur :

- modification des infos
- changement email (reset verification)
- suppression du compte

---

## 2. Gestion des utilisateurs

### UserController
Fonctions principales :

- liste des utilisateurs
- création utilisateur
- modification utilisateur
- suppression utilisateur
- attribution des rôles
- logs des actions (create / update / delete)

---

### RoleController
Fonctions :

- récupération du rôle utilisateur connecté
- affichage des pages accessibles selon rôle

---

## 3. Log & journalisation

### LogController
Fonctions :

- affichage des logs système
- filtrage (action, ip, utilisateur)
- suivi des activités utilisateurs

---

## 4. Logistique / Stock

### MaterielController
Fonctions :

- gestion inventaire matériel
- création matériel
- mise à jour matériel
- suppression (si non utilisé)
- alerte stock bas

---

### MouvementStockController
Fonctions :

- entrée de stock
- sortie de stock
- historique des mouvements
- mise à jour automatique du stock

---

### CommandeController
Fonctions :

- création de commandes fournisseurs
- ajout de matériels à une commande
- suivi des commandes
- mise à jour statut (livrée → incrémente stock)

---

### FournisseurController
Fonctions :

- gestion fournisseurs
- ajout / modification / suppression
- historique des commandes liées

---

## 5. Transport & logistique avancée

### TransportController
Fonctions :

- création transport
- liaison avec cargaison
- génération PDF bon de transport
- mise à jour statut transport
- marquer arrivée
- liste des PDF générés

---

### CargaisonController
Fonctions :

- création extraction
- gestion statut (Extrait → Transport → Stocké)
- liaison site / minerais / transport
- passage en transport
- passage en stockage

---

## 6. Terrain & capteurs

### CapteurController
Fonctions :

- liste capteurs
- filtres (type, localisation, fabricant)
- affichage détail capteur

---

### MesureController
Fonctions :

- filtrage des mesures (date, valeur, unité)
- affichage des mesures
- détail mesure

---

### CollecteController
Fonctions :

- liaison capteur ↔ mesure
- affichage des collectes
- filtres avancés
- détail collecte

---

### ReleveTerrainController
Fonctions :

- vue globale terrain
- filtres capteurs + collectes
- affichage combiné mesures/capteurs
- dashboard terrain

---

## 7. Production & ressources

### MineraisController
Fonctions :

- catalogue minerais
- ajout minerai
- détails + historique cargaisons

---

### SiteController
Fonctions :

- gestion sites d’extraction
- création site
- statistiques (volume total)
- derniers relevés

---

## 8. Activités & actualités

### ActivityController
Fonctions :

- liste actualités
- affichage détail actualité

---

### RapportController
Fonctions :

- création rapport
- modification rapport
- suppression
- filtrage mensuel / trimestriel
- archive

---

## 9. Contact

### ContactController
Fonctions :

- formulaire contact
- envoi email
- validation formulaire

---

## Résumé global

Architecture organisée en :

- Auth & Users
- Logistique / Stock / Transport
- Terrain / Capteurs
- Production (Sites / Minerais)
- Communication (Rapports / Contact)
```
