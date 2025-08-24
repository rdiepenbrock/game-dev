FROM php:7.2.6-fpm

COPY composer.* /var/www/

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    nano \
    build-essential \
    libmcrypt-dev zip unzip libzip-dev \
    libpng-dev libpq-dev libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt \
    && pecl install zip \
    && docker-php-ext-enable zip \
    && docker-php-ext-install pdo_pgsql

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www
COPY --chown=www-data:www-data . /var/www

USER root
RUN cat php-fpm-logging.txt >> /usr/local/etc/php-fpm.d/www.conf
RUN touch /var/log/fpm-php.www.log && chmod 777 /var/log/fpm-php.www.log \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public \
    && find /var/www -type d -exec chmod 755 {} \; \
    && find /var/www -type d -exec chmod ug+s {} \; \
    && find /var/www -type f -exec chmod 644 {} \; \
    && find /var/www/storage -type d -exec chmod 777 {} \; \
    && chmod -R ug+rwx /var/www/storage /var/www/bootstrap/cache \
    && mkdir -p /opt/bin

COPY ./start.sh /opt/bin
COPY ./wait-for-it.sh /opt/bin
RUN chmod u+x /opt/bin/*.sh

CMD ["/opt/bin/start.sh"]