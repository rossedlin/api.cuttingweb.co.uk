#!/usr/bin/env bash

sudo add-apt-repository -y ppa:ondrej/php
sudo apt-get update
sudo apt-get -y install php5.6

sudo apt-get -y install php5.6-mbstring
sudo apt-get -y install php5.6-mcrypt
sudo apt-get -y install php5.6-mysql
sudo apt-get -y install php5.6-sqlite
sudo apt-get -y install php5.6-xml
sudo apt-get -y install php5.6-gd
sudo apt-get -y install php5.6-curl