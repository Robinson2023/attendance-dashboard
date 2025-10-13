# Usa PHP 8.2 con las extensiones necesarias
FROM php:8.2-cli

# Instala dependencias del sistema y extensiones de PHP requeridas por Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Crea el directorio de trabajo
WORKDIR /var/www/html

# Copia el código del proyecto
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Genera clave APP_KEY automáticamente si no existe
RUN php artisan key:generate --force

# Exponer puerto 8000
EXPOSE 8000

# Comando para ejecutar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
