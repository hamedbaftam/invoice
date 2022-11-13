run:
	 docker-compose up -d --build && docker exec -it app composer i && docker exec -it app php artisan migrate && docker exec -it app php artisan test
