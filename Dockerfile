FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    nano \
    unzip zip

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ARG extensions="gd intl exif opcache pdo_mysql pdo_pgsql mysqli amqp pdo_pgsql pgsql gettext"

RUN install-php-extensions ${extensions}

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf

# Enable mod_env and mod_setenvif for environment variable support
RUN a2enmod env setenvif

# Enable mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Configure Apache to pass environment variables to .htaccess
RUN echo 'PassEnv APP_ENV' >> /etc/apache2/apache2.conf

EXPOSE 80
