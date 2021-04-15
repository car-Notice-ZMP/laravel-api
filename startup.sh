#!/bin/sh
set -e

composer install
composer update
mv .env.example .env
sed -i 's/DB_HOST=127.0.0.1/DB_HOST=db/g' .env
sed -i 's/DB_DATABASE=laravel/DB_DATABASE=laraapp_db/g' .env
sed -i 's/DB_PASSWORD=nothing/DB_PASSWORD=wp/g' .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate
chmod -R 777 storage
mkdir storage/app/public/notices
mkdir storage/app/public/users_avatars
php artisan storage:link
