FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev && \
    curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs && \
    docker-php-ext-install pdo_mysql mbstring bcmath && \
    apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY package.json package-lock.json composer.json composer.lock artisan ./

COPY app ./app
COPY bootstrap ./bootstrap
COPY config ./config
COPY database ./database
COPY routes ./routes

RUN composer install --no-interaction --prefer-dist && npm ci

COPY . .

RUN npm run build
