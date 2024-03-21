#!/bin/bash

docker-compose -f docker-compose.yml exec back php artisan key:generate
docker-compose -f docker-compose.yml exec back php artisan migrate
docker-compose -f docker-compose.yml exec back php artisan db:seed

