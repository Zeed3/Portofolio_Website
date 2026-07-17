#!/bin/sh
set -e
cd /app

# First run: create .env from the example if the container has none.
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Generate an app key if one isn't set yet.
if ! grep -q "^APP_KEY=base64:" .env; then
  php artisan key:generate --force
fi

# Clear any stale cached config baked into the image.
php artisan config:clear >/dev/null 2>&1 || true

exec "$@"
