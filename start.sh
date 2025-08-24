#!/bin/bash
pushd /var/www

if [[ ! -f .env ]];
then
    cp .env.example .env;
fi

php artisan key:generate
php artisan storage:link
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan config:cache
php artisan optimize

/opt/bin/wait-for-it.sh -h $DB_HOST -p 5432 -t 30 -- php artisan migrate:refresh --seed

popd
php-fpm