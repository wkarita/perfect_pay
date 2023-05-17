FROM php:8.1.19-fpm-alpine

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk update && apk add bash

RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 8082
