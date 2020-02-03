FROM composer:1.9.2 AS builder
COPY . /app
WORKDIR /app
RUN composer install --ignore-platform-reqs --no-scripts

FROM php:7.4.2-fpm-alpine3.10

COPY --from=builder /app /var/www

WORKDIR /var/www

RUN rm -rf _INFRA

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN apk update && apk add --no-cache \
            git \
            wget \
            unzip \
            curl \
            bash \
            libzip-dev \
            $PHPIZE_DEPS

RUN docker-php-ext-install pcntl pdo pdo_pgsql zip bcmath

# install php_redis which is recommended for laravel https://laravel.com/docs/6.x/redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis


COPY _INFRA/prod/php/start.sh /usr/local/bin/start

CMD ["/usr/local/bin/start"]
