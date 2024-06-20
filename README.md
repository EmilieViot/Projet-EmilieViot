
`Version GB`
## Description

This project is a showcase website developed using HTML, CSS, JavaScript, PHP 8.3, Twig, and Dotenv. It is designed to provide a showcase and encourage contact for a plastering business.

## Installation

To install and run this project locally, follow these steps:

# Clone the repository :

Open your terminal and run:
    `git clone https://github.com/votre-utilisateur/votre-projet.git`

---
# Navigate to the project directory:

    `cd Projet-EmilieViot`    

---
# Install PHP dependencies:       

    `composer install`

---
# Classes autoload:

*When cloning the project, you will get this folder structure:*

- assets
- controllers
- managers
- models
- services
- templates
- uploads
  
A vendor folder will be created by composer.

*Then modify the composer.json as follows to autoload the classes:*

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

*Each time you add a class in one of the folders, run:*

```sh
composer dump-autoload
```

---
# Prepare the .env

Create a .env.example file at the root of your project with the following content:

```txt
# Database info
DB_NAME=""
DB_USER=""
DB_PASSWORD=""
DB_CHARSET=""
DB_HOST=""
```

Then make a copy of this file named .env and add your database connection information.

*Create an index.php file at the root of the project with the following content:*

```php
<?php

// charge l'autoload de composer
require "vendor/autoload.php";

// charge le contenu du .env dans $_ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
```

---
# .gitignore File

Create a .gitignore file at the root of the project with the following content:

```txt
vendor/
.env
composer.lock
```

If you have created a repository for the project, run the following commands:

```sh
git add .gitignore
git commit -m "add gitignore"
git push
```

This will ensure that the folders and files that should not be online are not versioned.

---
# AbstractController

Here is the content of your AbstractController which initializes and calls Twig:

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

Here is the content of your AbstractManager which connects to the database using the information from your .env file:

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

---
# Database

A database structure is available at the root of the project; you just need to download it.

---
## Contributions

Contributions to the project are welcome. To contribute, please follow these steps:

1. Fork the repository.
2. Create a branch for your changes (git checkout -b feature/NewFeature).
3. Commit your changes (git commit -am 'Add new feature').
4. Push the branch to your fork (git push origin feature/NewFeature).
5. Create a new Pull Request.

---
## Author

Emilie Viot

---
## Acknowledgements

Mari D. Hugues F. Fabrice V. 3W Academy

---
## License
This project is licensed under the MIT License.


`Version FR`

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

*En clonant le projet vous récupérez cette architecture de dossiers :*

- assets
- controllers
- managers
- models
- services
- templates
- uploads
  
Un dossier vendor a été créé par composer.

*Modifiez ensuite le `composer.json` comme suit pour qu'il se charge d'autoloader les classes :*

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

*Ensuite à chaque fois que vous ajouterez une classe dans l'un des dossiers :*

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

*Créez ensuite un fichier `index.php` à la racine du projet avec le contenu suivant :*

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

---
# Base de données

Une structure de la base de données est disponible à la racine du projet, il suffira de le télécharger.

---
## Contributions

Les contributions au projet sont les bienvenues. Pour contribuer, veuillez suivre les étapes suivantes :

1. Forkez le dépôt.
2. Créez une branche pour vos modifications (git checkout -b feature/NouvelleFonctionnalité).
3. Committez vos modifications (git commit -am 'Ajout d'une nouvelle fonctionnalité').
4. Pushez la branche sur votre fork (git push origin feature/NouvelleFonctionnalité).
5. Créez une nouvelle Pull Request.

---
## Auteure

Emilie Viot

---
## Remerciements

Mari D. Hugues F. Fabrice V. La 3W Academy

---
## Licence
Ce projet est sous licence MIT. 