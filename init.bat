docker-compose -f docker-compose.yml up -d --build
docker exec -it talentifyapp composer install
timeout 10
docker exec -it talentifyapp php artisan migrate
docker exec -it talentifyapp php artisan db:seed