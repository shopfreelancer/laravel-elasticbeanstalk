FROM php:7.4-apache

COPY . /var/www
RUN rm -rf /INFRA

WORKDIR /var/www

RUN apt-get update && apt-get install --no-install-recommends -y \
        git \
        wget \
        wget \
        unzip \
        libpq-dev \
        libzip-dev

RUN docker-php-ext-install pcntl pdo pdo_pgsql zip bcmath

## no xdebug on production environment
#RUN pecl install xdebug-2.8.1 \
#    && docker-php-ext-enable xdebug

# install php_redis which is recommended for laravel https://laravel.com/docs/6.x/redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

COPY _INFRA/prod/php/start.sh /usr/local/bin/start
COPY _INFRA/prod/php/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/ \
    && chmod u+x /usr/local/bin/start \
    && a2enmod rewrite

# Install Composer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
# Make sure we're installing what we think we're installing!
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
&& rm -f /tmp/composer-setup.*

RUN composer install --ignore-platform-reqs --no-scripts

CMD ["/usr/local/bin/start"]
