FROM php:8.5-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN curl -sL https://deb.nodesource.com/setup_26.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

RUN npm install --global pnpm@11

WORKDIR /app

COPY composer.json composer.lock package.json pnpm-lock.yaml ./
RUN composer install --no-scripts --no-autoloader
RUN pnpm install --frozen-lockfile

COPY . .
RUN composer dump-autoload --optimize
RUN pnpm run build

CMD ["bash", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"]