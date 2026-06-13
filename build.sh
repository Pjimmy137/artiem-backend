#!/usr/bin/env bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
# Las migraciones las ejecutaremos luego a mano, no te preocupes
