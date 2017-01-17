#!/usr/bin/env bash

#Install required libraries
sudo apt-get -y install curl php5-cli git

#Download an install composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer