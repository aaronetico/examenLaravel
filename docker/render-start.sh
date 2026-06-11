#!/bin/sh
set -e
cd /var/www/html

mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache
chmod -R a+rwX storage bootstrap/cache 2>/dev/null || true

php artisan config:cache
php artisan route:cache

# 1. Borra tablas, migra y mete los seeds 
php artisan migrate --force

# 2. Arranca el servidor usando el puerto dinámico de Render 
exec php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
