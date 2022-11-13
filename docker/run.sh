#!/bin/sh
set -e
cd /var/www/app

#php artisan optimize:clear
php artisan optimize
php artisan storage:link
chown www:www-data  /var/www/app/storage
chmod -R 777 /var/www/app/storage

role=${CONTAINER_ROLE:-application}

if [ "$role" = "worker" ]; then
  /usr/bin/supervisord -c /etc/supervisord-worker.conf
  service cron start
else
  /usr/bin/supervisord -c /etc/supervisord.conf
fi



# php artisan migrate:fresh --seed


