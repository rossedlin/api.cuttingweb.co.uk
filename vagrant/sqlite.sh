#!/usr/bin/env bash

if [ ! -f /var/www/html/database/cryslo_api.sqlite ]; then
    echo "" > /var/www/html/database/cryslo_api.sqlite
fi

php artisan migrate