FROM php:7.4.2-fpm-alpine3.10

WORKDIR /var/www

RUN apk add --no-cache \
        $PHPIZE_DEPS \
        git \
        wget \
        unzip \
        postgresql-dev \
        libzip-dev \
        bash

RUN docker-php-ext-install pcntl pdo pdo_pgsql zip bcmath

# install php_redis which is recommended for laravel https://laravel.com/docs/6.x/redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis



# Install Composer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
# Make sure we're installing what we think we're installing!
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
&& rm -f /tmp/composer-setup.*

#RUN composer install --ignore-platform-reqs --no-scripts

COPY start.sh /usr/local/bin/start
RUN chmod 700 /usr/local/bin/start
#CMD ["php-fpm"]
CMD ["/usr/local/bin/start"]
