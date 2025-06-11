#

docker compose build 

docker compose up -d

docker compose exec app composer install

docker compose exec app php artisan key:gen 

docker compose exec app php artisan migrate

docker compose exec app php artisan db:seed



