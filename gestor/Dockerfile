# Usamos una imagen base que incluye Nginx y PHP-FPM
FROM richarvey/nginx-php-fpm:latest

# Copia tus archivos PHP a la raíz del servidor web
COPY . /var/www/html

# Si necesitas instalar extensiones de PHP, puedes hacerlo aquí
# Por ejemplo, para instalar pdo_pgsql:
RUN apk add --no-cache postgresql-dev \
     && docker-php-ext-install pdo_pgsql

# Si necesitas instalar Composer, puedes agregarlo aquí
# COPY --from=composer:latest /usr/local/bin/composer /usr/local/bin/composer

# Opcional: Instala dependencias de Composer si tu proyecto las tiene
#WORKDIR /var/www/html
#RUN composer install --no-dev --optimize-autoloader
