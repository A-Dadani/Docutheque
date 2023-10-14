# Docuthèque
Une bibliothèque complète pour la gestion de documents.

## Installation de php
1. Aller au [site de php](https://windows.php.net/download#php-8.2) et choisir la version appropriée. (Par exemple VS16 x64 Non Thread Safe - ZIP)
2. Extraire les fichiers et copier leur chemin
3. Ajouter le chemin à la variable d'environnement du system `PATH` :
    1. Dans Rechercher, lancez une recherche et sélectionnez : Système (Panneau de configuration)
    2. Cliquez sur le lien Paramètres système avancés
    3. Cliquez sur Variables d'environnement. Dans la section Variables système recherchez la variable d'environnement PATH et sélectionnez-la. Cliquez sur Modifier. Si la variable d'environnement PATH n'existe pas, cliquez sur Nouvelle
    4. Dans la fenêtre Modifier la variable système (ou Nouvelle variable système), Créez une nouvelle variable (nouvelle ligne) et indiquez le chemin déjà copié
    5. Cliquez sur OK. Fermez toutes les fenêtres restantes en cliquant sur OK

## Télécharger les fichiers
1. Sur [la page Github](https://github.com/A-Dadani/Docutheque) appuyez sur le bouton "Code" et ensuite "Télécharger ZIP"
2. Extraire l'archive et accéder au dossier nouvellement extrait

## Création des variables d'environnement
Dans un premier temps, il faut créer un fichier "`.env`" en suivant les étapes:
1. Trouvez le fichier nommé "`.env.example`" et le renommer en `.env`
2. Ouvrez le fichier `.env` nouvellement créé avec votre logiciel d'éditage de texte favori (VS Code, Sublime Text, Notepad++, ...)
3. Modifiez les valeurs suivantes (Ligne 11 à 16):
    - `DB_CONNECTION` : C'est le type de la base de données à utiliser (par exemple: mysql)
    - `DB_HOST` : C'est l'adresse IP de la base de données à utiliser (par exemple: 127.0.0.1 pour une base locale)
    - `DB_PORT`: C'est le port sur lequel le serveur de base de données écoute (par exemple: 3306 par défault pour MySQL)
    - `DB_DATABASE`: Le nom de la base de données à utiliser (par exemple: Docutheque)
    - `DB_USERNAME`: Le nom d'utilisateur à utiliser pour se connecter à la base de données
    - `DB_PASSWORD`: Le mot de passe correspondant au nom d'utilisateur déjà mentionné

4. Enregistrez les modifications

## Définition du mot de passe de l'administrateur racine
L'administrateur racine est le compte administrateur créé par défaut qui permet l'acceptation d'autres demandes de création de compte. Il est donc indispensable de le bien sécuriser.
1. Trouvez le fichier "`DatabaseSeeder.php`" situé dans le chemin `./database/seeders/` et ouvrez le avec votre logiciel d'éditage de texte favori (VS Code, Sublime Text, Notepad++, ...)
2.  Modifier les lignes 25, 26, et 27 pour refléter votre choix de nom, email et mot de passe respectivement. Par exemple si on veut que le nom soit : "Lorem IPSUM" et que l'email soit "lorem.ipsum@gmail.com" et que le mot de passe soit "Secret.123" le l'invocation `User::create` sera:
```php
User::create([
            'name' => 'Lorem Ipsum',
            'email' => 'lorem.ipsum@gmail.com',
            'password' => bcrypt('Secret.123'),
            'role' => 'admin',
            'department_id' => (DB::table('Departments')
                                    ->where('name', '=', 'blank')
                                    ->first())
                                ->id,
            'confirmed' => true
        ]);
``` 

## Installer composer
Maintenant que php est installé et que le code est bien configuré on doit installer `composer`:
1. Allez vers [le site officiel de composer](https://getcomposer.org/download/) et téléchargez le en appuyant sur `Download and run Composer-Setup.exe`.
2. Executez le fichier `Composer-Setup.exe` nouvellement téléchargé et installez le.

## Installer les packets et générer la clé d'application
1. Ouvrez une nouvelle instance d'interface de ligne de commandes Powershell en cherchant "Powershell"
2. Navigez vers le chemin où vous avez extrait le code en utilisant la commande `cd`. Par exemple si le chemin est: `C:\Users\monutilisateur\Downloads\docutheque-main`, la commande sera 
```bash
cd "C:\Users\monutilisateur\Downloads\docutheque-main"
``` 
3. Exécutez la commande pour vous assurer que votre fichier `lock` contient des packages compatibles: 
```bash
composer update
```
4. Exécutez la commande pour vous assurer que tout les packages sont bien installés:
```bash
composer install
```
5. Exécutrez le commande pour générer la clé d'application:
```bash
php artisan key:generate
```

## Lancer la migration et remplir la base de données
On peut maintenant commencer la migration des bases de données.
1. Ouvrez une instance d'interface de ligne de commandes Powershell en cherchant "Powershell"
2. Navigez vers le chemin où vous avez extrait le code en utilisant la commande `cd`. Par exemple si le chemin est: `C:\Users\monutilisateur\Downloads\docutheque-main`, la commande sera 
```bash
cd "C:\Users\monutilisateur\Downloads\docutheque-main"
``` 
3. Lancez les migration avec la commande:
```bash
php artisan migrate
```
4. Lancez la population de la base de données (seeding) avec la commande
```bash
php artisan db:seed --class=DatabaseSeeder
```

## Lancer le serveur
Si tout est bien déroulé la base de données sera bien configurée et remplie, il reste maintenant qu'à démarrer le programme avec la commande:
```bash
php artisan serve --host=HOTE --port=PORT
```
Avec `HOTE` étant l'adresse de l'hôte et `PORT` le numéro de port à utiliser. Par exemple, et par défaut, si on veut démarrer le serveur localement sur l'adresse de l'hôte `127.0.0.1` et le port `8080` la commande sera:
```bash
php artisan serve --host=127.0.0.1 --port=8080
```
Dans cet exemple on peut acceder au site en suivant l'adresse: `https://127.0.0.1:8080` (Google Chrome est recommandé)