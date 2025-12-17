# Watson Symfony

Comme certains d'entre vous ne maîtrisent pas encore le travail avec Docker, je vous ai rédigé ce petit guide pour vous aider à configurer et démarrer le projet Symfony avec une base de données PostgreSQL. L'usage Docker sera super utile pour vos futurs projets également ! N'hésitez pas à revenir vers moi si vous avez besoin d'aide lors de l'installation.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants sont installés sur votre machine :
- Docker
- Docker Compose
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

### 3. Configurer les variables d'environnement

Maintenant on devra configurer les variables d'environnement. Ces variables seront dans une première phase utilisées lors de la création du conteneur Docker Postgres. Dans une deuxième phase, Symfony utilisera ces mêmes variables pour se connecter à la base de données.

Commencez par copier le fichier d'exemple que j'ai crée pour vous :

```bash
cp .env.example .env.dev.local
```

Je sais qu'il y a beaucoup de fichiers du type `.env.*` dans Symfony, et si vous voulez en savoir plus, le fichier `.env` explique pourquoi cela est le cas. En tout cas, sâchez que les variables définies dans `.env.dev.local` prendront précédence sur celles définies dans `.env`.

Puis éditez `.env.dev.local` pour définir le mot de passe pour la base de données, le reste vous pouvez le laisser, vu qu'il s'agit d'une configuration locale. Voici un exemple de ce à quoi devrait ressembler votre fichier `.env.dev.local` :

```env
POSTGRES_DB=watson
POSTGRES_PORT=63788
POSTGRES_USER=app
# définissez votre mot de passe ci-dessous
POSTGRES_PASSWORD=ton_mot_de_passe

DATABASE_URL="postgresql://${POSTGRES_USER}:${POSTGRES_PASSWORD}@127.0.0.1:${POSTGRES_PORT}/${POSTGRES_DB}?serverVersion=16&charset=utf8"
```

**Important** : Assurez-vous de définir un mot de passe sécurisé et ne pushez jamais `.env.dev.local` dans le repository.

### 4. Lancer le serveur Symfony

Maintenant, lancez le serveur Symfony avec la commande suivante :

```bash
symfony server:start
```

### 5. Démarrer les conteneurs Docker

On y est presque ! Maintenant, démarrez les conteneurs Docker en utilisant cette commande :

```bash
docker compose up -d
```

Cela va démarrer un conteneur PostgreSQL avec les paramètres que vous avez définis dans `.env.dev.local`. Cette commande prendra en compte les fichiers `compose.yaml` et `compose.override.yaml` où les conteneurs/services sont définis.

### 6. Créer la base de données (si ce n'est pas encore fait)

Lorsque vous venez de lancer le conteneur PostgreSQL pour la première fois, vous devez créer la base de données en utilisant la commande Doctrine suivante :

**Note:** Doctrine est l'ORM utilisé par Symfony qui permettra d'utiliser des models (entités) pour interagir avec la base de données. C'est l'interface que Symfony offre pour interagir avec la base de données. Plus besoin d'écrire des queries SQL à la main grâce à ça !

```bash
php bin/console doctrine:database:create
```

### 7. Exécuter les migrations

Finalement, on a une base de données vide. On utilisera des migrations pour créer les tables nécessaires dans notre base de données. Une migration est une instruction qui modifie la structure de la base de données (par exemple, créer une table, ajouter une colonne, etc.). Lorsque vous souhaitez modifier la structure de la base de données, vous créez une nouvelle migration pour que vos coéquipiers pourront appliquer ces changements facilement dans leur propre environnement local !

Exécutez la commande suivante pour appliquer les migrations :

```bash
php bin/console doctrine:migrations:migrate
```

Et c'est tout ! Vous avez maintenant un projet Symfony fonctionnel avec une base de données PostgreSQL en utilisant Docker.

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
