# Usa PHP 8.2 con extensiones necesarias
FROM php:8.2-cli

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev nodejs npm && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia archivos del proyecto
COPY . .

# Copia .env de ejemplo si no existe
RUN cp .env.example .env || true

# Instala dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Genera APP_KEY
RUN php artisan key:generate --force || true

# Permisos
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

# Comando de ejecución
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
