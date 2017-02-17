#!/usr/bin/env bash

php artisan down
#php artisan migrate:install
php artisan migrate
php artisan up