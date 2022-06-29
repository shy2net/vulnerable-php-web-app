FROM php:7.2-apache
RUN docker-php-ext-install mysqli \
    && apt update && apt install -y iputils-ping