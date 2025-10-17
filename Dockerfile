# Usa PHP 8.2 con extensiones necesarias
FROM php:8.2-cli

# Instala dependencias del sistema y extensiones de PHP requeridas por Laravel
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Crea el directorio de trabajo
WORKDIR /var/www/html

# Copia el código del proyecto
COPY . .

# Copia archivo .env de ejemplo si no existe
RUN cp .env.example .env || true

# Instala dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Genera APP_KEY automáticamente
RUN php artisan key:generate --force || true

# Ajusta permisos para almacenamiento
RUN chmod -R 777 storage bootstrap/cache

# Expone el puerto 8000
EXPOSE 8000

# Comando para ejecutar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
