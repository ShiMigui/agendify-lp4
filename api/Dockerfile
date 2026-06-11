FROM php:8.4-cli

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
        git curl unzip zip libonig-dev ca-certificates \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql mbstring bcmath \
    && apt-get clean

COPY . .

RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction \
    && npm install --ignore-scripts \
    && npm run build

EXPOSE 8000

CMD ["sh", "-c", "php artisan storage:link 2>/dev/null && php artisan migrate && php artisan serve --host=0.0.0.0 --port=8000"]
