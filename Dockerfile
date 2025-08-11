FROM php:8.2-apache

# Installer PDO MySQL et autres extensions si besoin
RUN docker-php-ext-install pdo pdo_mysql

# Copier les fichiers de l'application
COPY app/ /var/www/html/

# Optionnel : Configurer Apache pour PHP
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Port exposé (Apache utilise 80 par défaut)
EXPOSE 80