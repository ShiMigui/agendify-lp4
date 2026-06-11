FROM php:8.4-cli

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN apt-get update && apt-get install -y \
    git curl unzip zip libonig-dev ca-certificates \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql mbstring bcmath \
    && apt-get clean

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --prefer-dist \
    --no-interaction

RUN npm ci && npm run build

EXPOSE 8000

CMD ["sh", "-c", "php artisan storage:link 2>/dev/null || true && php artisan serve --host=0.0.0.0 --port=8000"]
