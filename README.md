# Watson Symfony

Je vous ai rédigé ce petit guide pour vous aider à configurer et démarrer le projet Symfony avec une base de données SQLite. N'hésitez pas à revenir vers moi si vous avez besoin d'aide lors de l'installation.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants sont installés sur votre machine :

- PHP
- Composer
- Symfony-CLI

### Installer Symfony-CLI

Pour lancer le server local on utilisera Symfony-CLI. Vous pouvez l'installer si ce n'est pas encore fait en suivant les instructions sur [symfony.com/download (Step 1)](https://symfony.com/download#step-1-install-symfony-cli).

## Installation

### 1. Cloner le répo

```bash
git clone https://github.com/briantci/watson-symfony.git
cd watson-symfony
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Lancer le serveur Symfony

Maintenant, lancez le serveur Symfony avec la commande suivante :

```bash
symfony server:start
```

### 4. Exécuter les migrations

On utilisera des migrations pour créer les tables nécessaires dans notre base de données. Une migration est une instruction qui modifie la structure de la base de données (par exemple, créer une table, ajouter une colonne, etc.). Lorsque vous souhaitez modifier la structure de la base de données, vous créez une nouvelle migration pour que vos coéquipiers pourront appliquer ces changements facilement dans leur propre environnement local !

Exécutez la commande suivante pour appliquer les migrations :

```bash
php bin/console doctrine:migrations:migrate
```

Et c'est tout ! Vous avez maintenant un projet Symfony fonctionnel avec une base de données SQLite.

## Commandes utiles

Lorsque vous voulez dévlopper du code, assurez-vous s'il existe pas des commandes utiles qui pourront générer du code pour vous. Cela va vous faire gagner du temps et est une des meilleures pratiques dans Symfony.

Voici quelques exemples :

```bash
# Générer une entité
php bin/console make:entity

# Générer un contrôleur
php bin/console make:controller

# Générer un formulaire
php bin/console make:form

```
