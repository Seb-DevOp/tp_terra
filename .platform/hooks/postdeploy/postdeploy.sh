#!/bin/bash
echo "Postdeploy script"
sudo su
echo "Création des dossiers dans /var/current"
mkdir -p /var/current/storage/framework/sessions
mkdir -p /var/current/storage/framework/views
mkdir -p /var/current/storage/framework/cache
mkdir -p /var/current/storage/logs

echo "Changement des permissions des dossiers dans /var/current"
chmod -R 777 /var/current/storage 
chmod -R 777 /var/current/storage/framework
chmod -R 777 /var/current/storage/framework/sessions
chmod -R 777 /var/current/storage/framework/views
chmod -R 777 /var/current/storage/framework/cache
chmod -R 777 /var/current/storage/logs
chmod -R 777 /var/current/resources/lang/
chmod -R 777 /var/current/bootstrap/cache/

echo "Changement droit utilisateurs et groupes des dossiers dans /var/current"
chown -R root:root /var/current/storage

echo "Création des dossiers dans /var/www/html"
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/logs

echo "Changement des permissions des dossiers dans /var/www/html"
chmod -R 777 /var/www/html/storage 
chmod -R 777 /var/www/html/storage/framework
chmod -R 777 /var/www/html/storage/framework/sessions
chmod -R 777 /var/www/html/storage/framework/views
chmod -R 777 /var/www/html/storage/framework/cache
chmod -R 777 /var/www/html/storage/logs
chmod -R 777 /var/www/html/resources/lang/
chmod -R 777 /var/www/html/bootstrap/cache/

echo "Changement droit utilisateurs et groupes des dossiers dans /var/www/html"
chown -R root:root /var/www/html/storage

echo "Suppression du public/storage et création d'un lien symbolique"
cd /var/www/html/
rm -f public/storage && php artisan storage:link