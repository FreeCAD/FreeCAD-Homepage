FROM php:8.3-apache

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
#COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

ARG extensions="intl opcache gettext"

RUN install-php-extensions ${extensions}

# Enable mod_env and mod_setenvif for environment variable support
RUN a2enmod env setenvif

# Enable mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Configure Apache to pass environment variables to .htaccess
RUN echo 'PassEnv APP_ENV' >> /etc/apache2/apache2.conf

EXPOSE 80
