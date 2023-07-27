#!/bin/bash

cd /var/www/html
chmod -R 777 storage/

composer install

cp .env.example .env
#php artisan key:generate
#php artisan migrate

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
