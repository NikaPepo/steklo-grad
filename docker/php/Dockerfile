FROM php:8.4-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk update && \
    apk add --no-cache linux-headers autoconf gcc g++ make && \
    pecl install xdebug && \
    pecl install --onlyreqdeps --force redis \
    rm -rf /tmp/pear

RUN docker-php-ext-enable xdebug redis

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql bcmath

# Add PHP config:
COPY docker/php/conf.d/ $PHP_INI_DIR/conf.d/

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --chown=www-data:www-data . .

RUN composer install
