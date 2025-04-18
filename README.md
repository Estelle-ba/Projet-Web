# 🚀 Coding Tool Box – Guide d'installation

Bienvenue dans **Coding Tool Box**, un outil complet de gestion pédagogique conçu pour la Coding Factory.  
Ce projet Laravel inclut la gestion des groupes, promotions, étudiants, rétro (Kanban), QCM  dynamiques, et bien plus.

---

## 📦 Prérequis

Assurez-vous d’avoir les éléments suivants installés sur votre machine :

- PHP ≥ 8.1
- Composer
- MySQL ou MariaDB
- Node.js + npm (pour les assets frontend si nécessaire)
- Laravel CLI (`composer global require laravel/installer`)

---

## ⚙️ Installation du projet

Exécutez les étapes ci-dessous pour lancer le projet en local :

### 1. Cloner le dépôt

```bash
git clone https://github.com/Estelle-ba/Projet-Web.git
cd coding-tool-box
cp .env .env
```

### 2. Configuration de l'environnement

```bash
✍️ Ouvrez le fichier .env et configurez les paramètres liés à votre base de données :

DB_DATABASE=nom_de_votre_bdd
DB_USERNAME=utilisateur
DB_PASSWORD=motdepasse

GEMINI_API_KEY=la_clé_gemini
```

### 3. Installation des dépendances PHP

```bash
composer install
```

### 4. Nettoyage et optimisation du cache

```bash
php artisan optimize:clear
```

### 5. Génération de la clé d'application

```bash
php artisan key:generate
```

### 6. Migration de la base de données

```bash
php artisan migrate
```

### 7. Population de la base (Données de test)

```bash
php artisan db:seed
```

---

## 💻 Compilation des assets (si nécessaire)

```bash
npm install
npm run dev
```

---

## 👤 Comptes de test disponibles

| Rôle       | Email                         | Mot de passe |
|------------|-------------------------------|--------------|
| **Admin**  | admin@codingfactory.com       | 123456       |
| Enseignant | teacher@codingfactory.com     | 123456       |
| Étudiant   | student@codingfactory.com     | 123456       |

---

## 🚧 Fonctionnalités principales

- 🔧 Gestion des groupes, promotions, étudiants
- 📅 Vie commune avec système de pointage
- 📊 Bilans semestriels étudiants via QCM générés par IA
- 🧠 Génération automatique de QCM par langage sélectionné
- ✅ Système de Kanban pour les rétrospectives
- 📈 Statistiques d’usage et suivi pédagogique

## Backlog 2
### Toutes les stories sont faites
#### Common Life with the admin
- ✅ Peut ajouter une tâche avec un titre et une description
- ✅ Peut assigner une tâche à une promotion ou à toutes les promotions
- ⚠️ Peut modifier le titre d'une tâche
- ⚠️ Peut modifier la description d'une tâche
- ❌ Peut supprimer une tâche
- ❌ Peut enlever une promotion d'une tâche


#### Common Life with the student
- ✅ Peut terminer une tâche
- ✅ Peut ajouter un commentaire
- ⚠️ Peut modifier son commentaire
- ❌ Peut supprimer une tâche qu'il a effectuer de son historique

#### Test with the admin
- ✅ Peut ajouter un test d'un langage informatique avec son nombre de questions et de réponses
- ✅ Peut assigner un test à une promotion ou à toutes les promotions
- ❌ Peut supprimer un test
- ❌ Peut enlever une promotion d'un test

#### Test with the student
- ✅ Peut effectuer un test
- ✅ Peut voir sa note de test
