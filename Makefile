install: 
	composer install && cp .env.example .env && php artisan key:generate && sudo chmod 777 -R storage

db:
	php artisan migrate --path=database/migrations/owner && php artisan db:seed

test: 
	php artisan test --coverage