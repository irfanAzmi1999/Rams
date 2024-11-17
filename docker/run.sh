#!/bin/sh

cd /var/www/html

php artisan migrate
php artisan db:seed

php artisan cache:clear
php artisan route:clear
# php artisan key:generate

#yarn install
#yarn run prod

php artisan storage:link

#sed -i 's/$this->email/$this->emel/' /var/www/vendor/laravel/framework/src/Illuminate/Auth/Passwords/CanResetPassword.php

/usr/bin/supervisord -c /etc/supervisord.conf
