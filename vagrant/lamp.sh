#!/usr/bin/env bash

# vars
PASSWORD="vagrant"

#Install apache2
sudo apt-get -y install apache2
sudo mkdir /var/www/logs
sudo rm /var/www/html/index.html
sudo cp /var/www/html/vagrant/apache2/default.conf /etc/apache2/sites-available/000-default.conf

#Install mysql and give password to installer
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASSWORD"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASSWORD"
sudo apt-get -y install mysql-server

#Install PHP
/var/www/html/vagrant/php/php_v5.6.sh

#Enable Mod Rewrite
sudo a2enmod rewrite

#Enable SSL
sudo a2enmod ssl

sudo service apache2 restart