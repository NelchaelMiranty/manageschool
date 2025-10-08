# Installation du Système de Gestion Académique

## Prérequis

- PHP 7.4 ou supérieur
- Composer
- Supabase Database (déjà configuré)

## Instructions d'installation

### 1. Installer les dépendances PHP

```bash
composer install
```

Cela installera :
- `vlucas/phpdotenv` - Pour la gestion des variables d'environnement
- `supabase/supabase-php` - Client PHP pour Supabase

### 2. Configuration de l'environnement

Le fichier `.env` est déjà configuré avec vos identifiants Supabase :
- SUPABASE_URL
- SUPABASE_KEY

### 3. Base de données

La migration de base de données a déjà été appliquée avec les tables suivantes :
- `enseignants` - Gestion des enseignants
- `etudiants` - Gestion des étudiants
- `historique` - Historique des actions

### 4. Accéder à l'application

Pour accéder au nouveau système de gestion :

```
http://votre-domaine/index.php?action=gestionAcademiqueV2
```

## Structure MVC

### Model (model/frontend/)
- `EnseignantManager.php` - Gestion des enseignants
- `EtudiantManager.php` - Gestion des étudiants
- `HistoriqueManager.php` - Gestion de l'historique

### View (view/frontend/)
- `gestionAcademiqueV2View.php` - Interface principale

### Controller (controller/frontend.php)
Fonctions ajoutées :
- `gestionAcademiqueV2()` - Affichage de la vue
- `enseignantsList()` - Liste des enseignants
- `enseignantCreate()` - Créer un enseignant
- `enseignantUpdate()` - Modifier un enseignant
- `enseignantDelete()` - Supprimer un enseignant
- `etudiantsList()` - Liste des étudiants
- `etudiantCreate()` - Créer un étudiant
- `etudiantUpdate()` - Modifier un étudiant
- `etudiantDelete()` - Supprimer un étudiant
- `historiqueList()` - Liste de l'historique

## Routes disponibles

- `index.php?action=gestionAcademiqueV2` - Interface principale
- `index.php?action=enseignantsList` - API liste enseignants
- `index.php?action=enseignantCreate` - API créer enseignant
- `index.php?action=enseignantUpdate` - API modifier enseignant
- `index.php?action=enseignantDelete` - API supprimer enseignant
- `index.php?action=etudiantsList` - API liste étudiants
- `index.php?action=etudiantCreate` - API créer étudiant
- `index.php?action=etudiantUpdate` - API modifier étudiant
- `index.php?action=etudiantDelete` - API supprimer étudiant
- `index.php?action=historiqueList` - API liste historique

## Fonctionnalités

### Gestion des Enseignants
- Ajouter un enseignant (nom, prénom, mention, diplôme, établissement, CV)
- Modifier un enseignant
- Supprimer un enseignant
- Rechercher des enseignants
- Prévisualiser le CV

### Gestion des Étudiants
- Ajouter un étudiant (nom, prénom, niveau, mention, matricule, photo)
- Voir les détails d'un étudiant
- Affichage en carte avec avatar

### Historique
- Suivi automatique des inscriptions
- Suivi des modifications
- Suivi des suppressions

## Connexion

Pour se connecter à l'interface, entrez n'importe quel nom d'utilisateur et mot de passe (authentification simple pour démonstration).

## Notes importantes

- Les fichiers CV et photos sont stockés en base64 dans Supabase
- L'historique est automatiquement créé lors des opérations sur les étudiants
- L'interface utilise Bootstrap 5, AOS animations et SweetAlert2
