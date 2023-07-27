FROM php:8.1-apache

WORKDIR /var/www/html

# Copy the custom entrypoint script to the container
COPY docker/custom-entrypoint.sh /usr/local/bin/custom-entrypoint
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN apt-get update \
    && apt-get install -y zlib1g-dev libpng-dev libjpeg-dev libjpeg62-turbo-dev libfreetype6-dev git zip libzip-dev supervisor \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && a2enmod rewrite headers proxy ssl proxy_http http2 alias \
    && chmod 755 /usr/local/bin/custom-entrypoint \
    # Install Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # Finish
    && echo 'End'

RUN sed -i 's/\/var\/www\/html/\/var\/www\/html\/public/' /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html

ENTRYPOINT [ "custom-entrypoint" ]
