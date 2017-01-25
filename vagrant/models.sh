#!/usr/bin/env bash

cd /var/www/html
php artisan krlove:generate:model Heartbeat --table-name=cry_heartbeat
php artisan krlove:generate:model HeartbeatCode --table-name=cry_heartbeat_code