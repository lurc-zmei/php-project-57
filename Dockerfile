FROM php:8.5-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev \
    libzip-dev \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pdo_pgsql zip
# RUN docker-php-ext-configure pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_26.x | bash -
RUN apt-get install -y nodejs
RUN npm install --global pnpm@11

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-interaction --prefer-dist

COPY package.json pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile

COPY . .

RUN composer dump-autoload --optimize
RUN pnpm run build

ENV PORT=80

CMD ["bash", "-c", "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"]