FROM php:7.2-apache

# Install the required deps
RUN docker-php-ext-install mysqli \
    && apt update && apt install -y iputils-ping

# Copy the source files
COPY ./src /var/www/html/

# Fix ownership
RUN chown www-data -R /var/www/html/*