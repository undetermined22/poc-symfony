

# Étapes d'installation

## Configuration du fichier `.env`

Configurez le mot de passe pour votre base de données.

```conf
MSSQL_SA_PASSWORD=<Votre Mot De Passe>
```
___

## Lancer les conteneurs

```bash
$ docker-compose -f docker-compose.yml up -d --build
```
___

## Configuration de la base de donnée

Connectez-vous au conteneur de MS SQL Server en utilisant la commande suivante:

```bash
$ docker exec -it poc_symfony_mssql bash
```
Pour créer la base de donnée tapez la commande suivante:

```bash
$ /opt/mssql-tools/bin/sqlcmd -S localhost -U SA
```
N.B. Vous serez invité à saisir un mot de passe, utilisez le mot de passe que vous avez configuré dans le fichier `.env`

Puis créez la base de données avec la commande suivante:

```sql
1> CREATE DATABASE poc_symfony;
2> GO
```
___

## Migration de la base de donnée

Connectez-vous au conteneur de PHP en utilisant la commande suivante:

```bash
$ docker exec -it poc_symfony_php bash
```
Pour créer migrer les tables tapez la commande suivante:

```bash
$ symfony console doctrine:migrations:migrate
```
___

## Execution des tests unitaires

Avant d'executer les commandes de test preparer l'environnement:

```bash
$ symfony console doctrine:database:create --env=test
$ symfony console doctrine:migrations:migrate -n --env=test
```

Puis la commande suivante:

```bash
$ APP_ENV=test ./vendor/bin/phpunit
```
___

## Execution des tests de conformité de code

executez la commande suivante:

```bash
$ ./vendor/bin/phpcs
```
___

## Execution d'analyse statique

executez la commande suivante:

```bash
$ ./vendor/bin/phpstan
```