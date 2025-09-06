# Usamos PHP 8.3 con servidor Apache
FROM php:8.3-apache

# Habilitar extensiones necesarias
RUN docker-php-ext-install pdo pdo_sqlite sqlite3

# Copiar todo el proyecto al contenedor
COPY . /var/www/html/

# Establecer permisos (opcional)
RUN chown -R www-data:www-data /var/www/html/

# Exponer el puerto 80
EXPOSE 80

# Instrucción por defecto
CMD ["apache2-foreground"]
