#!/bin/bash

DATE=`date "+%Y-%m-%d"`
# access.log
touch /var/log/nginx/access.log
chown nginx:nginx /var/log/nginx/access.log
# error.log
touch /var/log/nginx/error.log
chown nginx:nginx /var/log/nginx/error.log

touch /var/log/php-fpm/error.log
# laravel-${DATE}.log
touch /var/www/html/storage/logs/laravel-${DATE}.log
chown nginx:nginx /var/www/html/storage/logs/laravel-${DATE}.log

composer self-update --1 # composerのバージョンを1下げる
composer install
[ "$(php artisan migrate:status)" = 'No migrations found.' ] && php artisan migrate:refresh --seed && php artisan db:seed --class=DatabaseSeeder

exit 0
