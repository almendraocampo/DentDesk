# Uso la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalo dependencias necesarias para SQLite y otras extensiones
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Copio los archivos de la app al contenedor
COPY . /var/www/html/

# Puerto 80
EXPOSE 80
