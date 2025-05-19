FROM php:8.2-apache

# Active mod_rewrite (utile si tu fais des redirections ou du routing propre)
RUN a2enmod rewrite

# 🔧 Installe les extensions PostgreSQL nécessaires
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# 🔍 Active les erreurs PHP pour le développement
RUN echo "display_errors=On" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "display_startup_errors=On" >> /usr/local/etc/php/conf.d/docker-php.ini \
    && echo "error_reporting=E_ALL" >> /usr/local/etc/php/conf.d/docker-php.ini

# Copie ton code HTML/PHP dans Apache
COPY html/ /var/www/html/

# Donne les bons droits (optionnel)
RUN chown -R www-data:www-data /var/www/html
