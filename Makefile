install: 
	composer install && cp .env.example .env && php artisan key:generate && sudo chmod 777 -R storage

db:
	php artisan migrate:fresh && php artisan db:seed

test: 
	php artisan test --coverage