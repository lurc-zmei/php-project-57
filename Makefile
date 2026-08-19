start:
	php artisan serve --host 0.0.0.0

install: setup

setup:
	composer install
	php artisan key:gen --ansi
	php artisan migrate
	pnpm install --frozen-lockfile
	pnpm run build