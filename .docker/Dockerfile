FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
        libicu-dev \
        libzip-dev \
        libc-client-dev\
        libkrb5-dev\
    && PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install -j$(nproc) imap \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install sockets

# Install Composer
COPY --from=composer:2.5.8 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]
