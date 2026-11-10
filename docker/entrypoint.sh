#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
  cp .env.example .env
fi

# Ensure APP_KEY exists
if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
  php artisan key:generate --force
fi

php artisan package:discover --ansi || true
php artisan filament:assets || true
php artisan migrate --force
php artisan db:seed --force

exec php artisan serve --host=0.0.0.0 --port=8108
