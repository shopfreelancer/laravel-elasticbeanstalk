FROM composer:1.9.2 AS builder
COPY ../../../ /app
WORKDIR /app
RUN composer install --ignore-platform-reqs --no-scripts

FROM php:7.4-apache

COPY --from=builder /app /var/www

WORKDIR /var/www

RUN rm -rf _INFRA

RUN apt-get update && apt-get install --no-install-recommends -y \
        git \
        wget \
        wget \
        unzip \
        libpq-dev \
        libzip-dev

RUN docker-php-ext-install pcntl pdo pdo_pgsql zip bcmath

# install php_redis which is recommended for laravel https://laravel.com/docs/6.x/redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

COPY _INFRA/prod/php/start.sh /usr/local/bin/start

COPY _INFRA/prod/php/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/ \
    && chmod u+x /usr/local/bin/start \
    && a2enmod rewrite

CMD ["/usr/local/bin/start"]
