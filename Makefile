start:
	docker compose up --build
setup:
	composer install
	cp -n .env.example .env || true
	php artisan key:generate
	touch database/database.sqlite
	php artisan migrate
	npm ci
	npm run build

test:
	php artisan test

lint:
	./vendor/bin/pint --test
	./vendor/bin/phpstan analyse