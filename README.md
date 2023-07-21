

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
$ docker exec -it prdg_mssql bash
```
Pour créer la base de donnée tapez la commande suivante:

```bash
$ /opt/mssql-tools/bin/sqlcmd -S localhost -U SA
```
N.B. Vous serez invité à saisir un mot de passe, utilisez le mot de passe que vous avez configuré dans le fichier `.env`

Puis créez la base de données avec la commande suivante:

```sql
1> CREATE DATABASE prdg;
2> GO
```