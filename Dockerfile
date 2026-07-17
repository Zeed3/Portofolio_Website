# syntax=docker/dockerfile:1

# ---- Stage 1: install PHP dependencies with Composer ----
# Isolated so the final image never needs Composer itself.
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
      --no-dev \
      --no-scripts \
      --no-interaction \
      --prefer-dist \
      --no-progress

# ---- Stage 2: runtime ----
FROM php:8.5-cli AS app

# install-php-extensions handles system deps for us (cleaner than raw docker-php-ext-install).
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions mbstring bcmath opcache

WORKDIR /app

# App source, then vendored dependencies from the Composer stage.
COPY . .
COPY --from=vendor /app/vendor ./vendor

# Laravel needs these writable at runtime.
RUN chmod -R 775 storage bootstrap/cache

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

EXPOSE 8000
ENTRYPOINT ["entrypoint"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
