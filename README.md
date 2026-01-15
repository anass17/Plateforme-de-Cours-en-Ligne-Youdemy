Ce README est en français. Pour la version anglaise, voir [README_en.md](README_en.md).

# Youdemy – Plateforme de Cours en Ligne

## Description du projet

Youdemy est une plateforme de cours en ligne conçue pour moderniser et faciliter l’apprentissage en proposant une expérience interactive, structurée et personnalisée pour les étudiants et les enseignants.
Elle permet la gestion complète des cours, des utilisateurs et des statistiques à travers une architecture sécurisée.

---

## Fonctionnalités

### Visiteur

- Accès au catalogue des cours avec pagination
- Recherche de cours par mots-clés
- Création d’un compte avec choix du rôle :
    - Étudiant
    - Enseignant

### Étudiant

- Consultation du catalogue des cours
- Recherche et affichage des détails d’un cours :
    - Description
    - Contenu
    - Enseignant
- Inscription à un cours (authentification requise)
- Accès à l’espace “Mes cours”

### Enseignant

- Ajout de nouveaux cours avec :
    - Titre
    - Description
    - Contenu (vidéo ou document)
    - Tags
    - Catégorie
- Gestion des cours :
    - Modification
    - Suppression
    - Consultation des inscriptions

### Administrateur

- Validation des comptes enseignants
- Gestion des utilisateurs :
    - Activation
    - Suspension
    - Suppression
- Gestion des contenus :
    - Cours
    - Catégories
    - Tags

- Insertion en masse de tags
- Accès aux statistiques globales :
    - Nombre total de cours
    - Répartition des cours par catégorie
    - Cours le plus suivi
    - Top 3 des enseignants

### Sécurité

- Système d’authentification et d’autorisation
- Contrôle d’accès basé sur les rôles

---

## Technologies Utilisées

- **PHP (OOP)**
- **MySQL**
- **PDO**
- **Composer**
- **HTML / CSS / JavaScript**
- **Dotenv** pour la gestion des variables d’environnement

---

## Installation et Utilisation

### Prérequis

Assurez-vous d’avoir installé les outils suivants sur votre machine :
- `PHP` (version 8.0 ou supérieure)
- `MySQL`
- `Composer` (gestionnaire de dépendances PHP)

Vérification des versions

```Bash
php -v
mysql --version
composer -V
```

### Installation du projet

**1. Cloner le projet**

```Bash
git clone https://github.com/anass17/Plateforme-de-Cours-en-Ligne-Youdemy.git
cd Plateforme-de-Cours-en-Ligne-Youdemy
```

**2. Installation des dépendances PHP**

```Bash
composer install
```

Cette commande :

- Installe les dépendances nécessaires
- Génère le dossier `vendor/`
- Configure l’autoload des classes

**3. Configuration des variables d’environnement**

Copier le fichier d’exemple :

```Bash
cp .env_example .env
```

Modifier le fichier `.env` avec vos informations locales

**4. Création de la base de données**

- Créer la base de données :

```SQL
CREATE DATABASE youdemy;
```

- Importer les tables depuis le script SQL :

```Bash
mysql -u root -p youdemy < sql/script.sql
```

Le fichier `script.sql` se trouve dans :

```
/SQL/script.sql
```

**5. Lancer le serveur PHP intégré (recommandé)**

```Bash
php -S localhost:8000
```

Puis accéder à l’application via :

```
http://localhost:8000
```

**6. Comptes de test (exemple)**

| Rôle         | Email	                        | Mot de passe  |
| ------------ | ------------------------------ | ------------- |
| Admin        | ahmed.elfassi@example.com      | 123456789     |
| Enseignant   | fatima.benali@example.com      | 123456789     |
| Étudiant     | sara.elmansouri@example.com    | 123456789     |

---

## Notes

- Vérifier que l’extension `pdo_mysql` est activée dans `php.ini`

---

## Visualisations

## Interfaces

![Home Page](https://github.com/user-attachments/assets/baeed7df-00fd-44c8-95d2-f1ac72cf4575)
![Login](https://github.com/user-attachments/assets/f791046d-7316-4bb1-90e0-4fc3dce4a3cb)
![Courses](https://github.com/user-attachments/assets/b8d67823-ee90-436c-ba87-a71603292e65)
![Dashboard](https://github.com/user-attachments/assets/c60fdcf1-71cc-4409-80bb-587442c42251)
![Add Review](https://github.com/user-attachments/assets/575d62aa-2ac4-4159-b95a-aafb2e4c8904)

## Diagrammes

![Use Case Diagram](https://github.com/user-attachments/assets/65e0b740-412c-4873-876d-3421b171b598)
![Class Diagram](https://github.com/user-attachments/assets/549b1cf6-e711-4a08-afe2-080398c75553)