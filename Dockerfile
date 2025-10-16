# Usa una imagen oficial de PHP con extensiones necesarias
FROM php:8.2-cli

# Instala dependencias del sistema y extensiones requeridas por Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Crea el directorio de trabajo
WORKDIR /var/www/html

# Copia todo el proyecto Laravel
COPY . .

# Copia .env.example como .env (si no existe aún)
RUN cp .env.example .env || true

# Instala dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Genera la clave de aplicación
RUN php artisan key:generate --force || true

# Asigna permisos a storage y bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Exponer el puerto 8000 (Laravel)
EXPOSE 8000

# Comando por defecto
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
