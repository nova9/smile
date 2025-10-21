# Stage 1: Build stage
FROM composer:2.7 AS composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

FROM node:alpine AS node

WORKDIR /app

COPY --from=composer /app ./

COPY . .
RUN npm install
RUN npm run build

# Stage 2: Application build stage
FROM php:8.3-fpm-alpine AS app

WORKDIR /var/www/html

RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    && rm -rf /var/cache/apk/*

RUN docker-php-ext-install pdo_mysql

COPY --from=node /app ./

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create necessary directories and set permissions
RUN mkdir -p /var/run/php \
    && mkdir -p /var/log/supervisor \
    && mkdir -p /run/nginx \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose port for Nginx
EXPOSE 80

# Start Supervisor (which will manage nginx, php-fpm, and queue workers)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

