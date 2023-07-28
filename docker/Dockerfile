FROM php:8.2-apache

WORKDIR /app

# Copy the custom entrypoint script to the container
COPY custom-entrypoint.sh /usr/local/bin/custom-entrypoint
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt update \
    && apt install -y zlib1g-dev libpng-dev libjpeg-dev libjpeg62-turbo-dev libfreetype6-dev git zip libzip-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && a2enmod rewrite headers proxy ssl proxy_http http2 alias \
    && chmod 755 /usr/local/bin/custom-entrypoint \
    && cd /usr/local/bin/ \
    # Install Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # Finish
    && echo 'End'

ENTRYPOINT [ "custom-entrypoint" ]

WORKDIR /var/www/html