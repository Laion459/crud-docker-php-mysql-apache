# src/Dockerfile
FROM php:8.3.3-apache

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Copy source files to /var/www/html
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install PDO extension for MySQL
RUN docker-php-ext-install pdo pdo_mysql