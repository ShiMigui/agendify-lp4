#!/bin/sh
set -e

composer install --prefer-source --no-interaction
npm install --ignore-scripts
npm run build

grep -qE '^APP_KEY=base64:.+' .env || php artisan key:generate --force
php artisan storage:link --force 2>/dev/null || true
php artisan migrate --force

exec "$@"
