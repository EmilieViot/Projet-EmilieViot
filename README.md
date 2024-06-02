
## Description

Ce projet est un site Web vitrine développé via HTML, CSS, JavaScript, PHP 8.3, Twig, et Dotenv. Il est conçu pour fournir une vitrine et inciter à la prise de contact pour une entreprise de travaux de plaquisterie.

## Installation

Pour installer et exécuter ce projet localement, suivez ces étapes :

# Clonez le dépôt :

    Rendez-vous dans votre terminal :
    `git clone https://github.com/votre-utilisateur/votre-projet.git`

---
# Accédez au répertoire du projet :

    `cd Projet-EmilieViot`    

---
# Installez les dépendances PHP :       

    `composer install`

---
# Autoload des classes :

En clonant le projet vous récupérez cette architecture de dossiers :

- assets
- controllers
- managers
- models
- services
- templates
- uploads
  
Un dossier vendor a été créé par composer.

Modifiez ensuite le `composer.json` comme suit pour qu'il se charge d'autoloader les classes :

```json
{
    "autoload": {
        "classmap": [
            "controllers/",
            "managers/",
            "models/",
            "services/"
        ]
    },
    "require": {
        "vlucas/phpdotenv": "^5.6",
        "twig/twig": "^3.0"
    },
    "require-dev": {
        "symfony/var-dumper": "^7.0"
    }
}
```

Ensuite à chaque fois que vous ajouterez une classe dans l'un des dossiers :

```sh
composer dump-autoload
```

---
# Préparez le .env

Créez un fichier `.env.example` à la racine de votre projet, et mettez y le contenu suivant :

```txt
# Database info
DB_NAME=""
DB_USER=""
DB_PASSWORD=""
DB_CHARSET=""
DB_HOST=""
```

ensuite faites une copie de ce fichier que vous appellerez `.env` et ajoutez-y les bonnes informations de connexion à votre base de données.

Créez ensuite un fichier `index.php` à la racine du projet avec le contenu suivant :

```php
<?php

// charge l'autoload de composer
require "vendor/autoload.php";

// charge le contenu du .env dans $_ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
```

---
# Le .gitignore

Créez un fichier `.gitignore` à la racine du projet et mettez-y le contenu suivant :

```txt
vendor/
.env
composer.lock
```

Si vous avez créé un repository pour le projet faites les commandes suivantes :

```sh
git add .gitignore
git commit -m "add gitignore"
git push
```

Afin de ne pas versionner les dossiers et fichiers qui ne devraient pas être en ligne.

---
# AbstractController

Voici le contenu de votre AbstractController qui initialise et appelle Twig :

```php
abstract class AbstractController
{
    private \Twig\Environment $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader,[
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        $this->twig = $twig;
    }

    protected function render(string $template, array $data) : void
    {
        echo $this->twig->render($template, $data);
    }
}
```

---
# AbstractManager

Voici le contenu de votre AbstractManager qui se connecte à la base de données avec les informations de votre fichier `.env` :

```php
abstract class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
        $connexion = "mysql:host=".$_ENV["DB_HOST"].";port=3306;charset=".$_ENV["DB_CHARSET"].";dbname=".$_ENV["DB_NAME"];
        $this->db = new PDO(
            $connexion,
            $_ENV["DB_USER"],
            $_ENV["DB_PASSWORD"]
        );
    }
}
```