FROM php:8.2-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-ram-limit.ini

RUN useradd -ms /bin/bash app
USER app