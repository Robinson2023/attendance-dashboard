# ============================
# Etapa 1: Compilar assets con Node
# ============================
FROM node:20-alpine AS build

# Directorio de trabajo
WORKDIR /app

# Copiamos solo lo necesario para instalar dependencias primero
COPY package*.json ./

# Instalamos dependencias (producción y desarrollo)
RUN npm install

# Copiamos el resto del proyecto
COPY . .

# Compilamos los assets con Vite
RUN npm run build


# ============================
# Etapa 2: Entorno de PHP/Laravel
# ============================
FROM php:8.2-fpm

# Instalar dependencias del sistema necesarias para PHP y extensiones
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev mariadb-client && \
    docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd && \
    rm -rf /var/lib/apt/lists/*

# Copiamos Composer desde su imagen oficial
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Definimos el directorio de trabajo
WORKDIR /var/www/html

# Copiamos los archivos del proyecto (sin node_modules)
COPY . .

# Copiamos los assets compilados desde la etapa anterior
COPY --from=build /app/public/build ./public/build

# Copiamos el archivo .env si no existe
RUN cp .env.example .env || true

# Instalamos dependencias PHP (sin dev)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Generamos la clave de aplicación
RUN php artisan key:generate --force || true

# Damos permisos a los directorios necesarios
RUN chmod -R 777 storage bootstrap/cache

# Exponemos el puerto 8000
EXPOSE 8000

# Comando por defecto al iniciar el contenedor
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
