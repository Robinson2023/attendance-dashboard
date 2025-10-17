# Usa PHP 8.2 con extensiones necesarias
FROM php:8.2-cli

# Instalar dependencias del sistema, PHP y Node.js
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copia el código
COPY . .

# Copia archivo .env si no existe
RUN cp .env.example .env || true

# Instala dependencias PHP y Node
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm install && npm run build

# Genera la APP_KEY
RUN php artisan key:generate --force || true

# Permisos de carpetas
RUN chmod -R 777 storage bootstrap/cache

# Exponer puerto
EXPOSE 8000

# Ejecutar Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
