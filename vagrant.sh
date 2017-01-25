#!/usr/bin/env bash

if [ -f /install.log ]; then
    echo "Install Log Found, Restarting Apache..." >> /install.log
    sudo service apache2 restart >> /install.log
    exit 0
else
    echo "Installing..." >> /install.log
fi

echo "Update/Upgrade the Server" >> /install.log
sudo apt-get -y update
sudo apt-get -y upgrade

echo "Install composer" >> /install.log
/var/www/html/vagrant/composer.sh

echo "Install LAMP stack" >> /install.log
/var/www/html/vagrant/lamp.sh

echo "Install ZIP" >> /install.log
/var/www/html/vagrant/zip.sh

echo "Copy Environment Config" >> /install.log
cd /var/www/html
rm .env
cp vagrant/.env .env

echo "Generate SQLight Database" >> /install.log
cd /var/www/html
vagrant/sqlite.sh

echo "Composer Update" >> /install.log
cd /var/www/html
composer update

echo "Generate IDE Helper" >> /install.log
cd /var/www/html
rm _ide_helper.php
php artisan ide-helper:generate

echo "Generate PhpStorm META" >> /install.log
cd /var/www/html
rm .phpstorm.meta.php
php artisan ide-helper:meta

#php artisan ide-helper:models