# Usa PHP con las extensiones necesarias
FROM php:8.2-cli

# Instala dependencias del sistema y Node.js + npm
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev nodejs npm && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto
COPY . .

# Copia el archivo de entorno si no existe
RUN cp .env.example .env || true

# Instala dependencias PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Instala dependencias de Node y compila los assets
RUN npm install && npm run build

# Genera la clave de la aplicación Laravel
RUN php artisan key:generate --force || true

# Asigna permisos necesarios
RUN chmod -R 777 storage bootstrap/cache

# Expone el puerto 8000
EXPOSE 8000

# Comando por defecto al iniciar el contenedor
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
