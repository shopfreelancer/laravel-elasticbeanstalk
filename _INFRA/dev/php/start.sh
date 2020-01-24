#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}

if [[ "$role" = "app" ]]; then

    exec apache2-foreground

elif [[ "$role" = "websockets" ]]; then

    echo "Running the Laravel WebSockets..."
    php /var/www/artisan websockets:serve --host=0.0.0.0

elif [[ "$role" = "queue" ]]; then

    echo "Running the queue..."
    php /var/www/artisan horizon

elif [[ "$role" = "scheduler" ]]; then

    while [[ true ]]
    do
        php /var/www/artisan schedule:run --verbose --no-interaction &
        sleep 60
    done

elif [[ "$role" = "testing" ]]; then
    env=testing
    ./vendor/bin/phpunit

else
  echo "Could not match the container role \"$role\""
  exit 1
fi
