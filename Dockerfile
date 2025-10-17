# Imagen base con PHP y Composer
FROM php:8.2-cli

# Instalar dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Instalar Node.js y npm (necesario para compilar assets de Laravel)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Copiar Composer desde imagen oficial
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el código del proyecto
COPY . .

# Crear archivo .env si no existe
RUN cp .env.example .env || true

# Instalar dependencias PHP y JS
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm install
RUN npm run build || npm run dev

# Generar APP_KEY automáticamente
RUN php artisan key:generate --force || true

# Dar permisos a Laravel
RUN chmod -R 777 storage bootstrap/cache

# Exponer el puerto
EXPOSE 8000

# Comando para ejecutar la aplicación
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
