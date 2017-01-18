#!/usr/bin/env bash

rm /var/www/html/database/cryslo_api.sqlite
echo > /var/www/html/database/cryslo_api.sqlite
php artisan migrate