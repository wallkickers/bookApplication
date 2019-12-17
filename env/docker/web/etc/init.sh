#!/bin/bash

DATE=`date "+%Y-%m-%d"`
sudo -u nginx touch /var/log/nginx/access.log
sudo -u nginx touch /var/log/nginx/error.log
touch /var/log/php-fpm/error.log
sudo -u nginx touch /var/www/html/storage/logs/laravel-${DATE}.log
mkdir -p /var/www/html/storage/logs/batch && sudo -u nginx touch /var/www/html/storage/logs/batch/batch-${DATE}.log

composer install
[ "$(php artisan migrate:status)" = 'No migrations found.' ] && php artisan migrate:refresh --seed && php artisan db:seed --class=TestDataSeeder

exit 0
