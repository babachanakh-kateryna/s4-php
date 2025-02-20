# 📌 Toutes données utiles ou nécessaires à l’exécution du code (WSL & Windows)

## 1. Configurer la base de données (`conf.ini`)

Créer un fichier `conf.ini` avec la configuration suivante :

```ini
driver = mysql
host = localhost
dbname = jeuxvideo
username = root
password = 
charset = utf8
collation = utf8_unicode_ci
```

## 2. Installer Laravel Eloquent avec Composer

Exécuter la commande suivante dans le terminal :

```
composer require illuminate/database
```

## 3. Démarrer MySQL

**Sous WSL :**

```
sudo service mysql start
mysql -u root -p
```

**Sous Windows (XAMPP) :**

1. Ouvrir XAMPP
2. Démarrer Apache et MySQL
3. Vérifier la connexion avec :
   
```
mysql -u root -p
```

## 4. Importer la base de données

**Sous WSL :**

```
pv games_data.sql | mysql -u root -p JeuxVideo
```

## 5. Lancer le serveur PHP

**Sous WSL :**

```
php -S localhost:8000 -t public
```

**Sous Windows (XAMPP) :**

1. Placer les fichiers PHP dans :
   
```
C:\xampp\htdocs\jeuxvideo\
```

2. Accéder au projet via le navigateur :
   
```
http://localhost/jeuxvideo/
```
