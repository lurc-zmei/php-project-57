start:
	cp -n .env.example .env || true
	docker compose up --build --watch