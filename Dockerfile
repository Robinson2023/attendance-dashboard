# Etapa 1: Construcción de dependencias
FROM node:20-alpine as build

WORKDIR /app

# Copiamos solo los archivos necesarios para npm
COPY package*.json ./
RUN npm install

# Copiamos el resto del proyecto
COPY . .

# Construimos los assets con Vite
RUN npm run build

# Etapa 2: Aplicación PHP
FROM php:8.2-fpm

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev mariadb-client && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo
WORKDIR /var/www/html

# Copia el proyecto Laravel
COPY . .

# Copia los archivos compilados desde la etapa anterior (Vite)
COPY --from=build /app/public/build ./public/build

# Copia el archivo de entorno
RUN cp .env.example .env || true

# Instala dependencias de PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Genera la clave de aplicación
RUN php artisan key:generate --force || true

# Asigna permisos
RUN chmod -R 777 storage bootstrap/cache

# Expone el puerto
EXPOSE 8000

# Comando por defecto
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
