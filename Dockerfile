FROM php:8.2-apache

# Install system dependencies for postgres driver
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql pgsql

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Copy project files to the container
COPY . /var/www/html/

# Set strict permissions for security
RUN chown -R www-data:www-data /var/www/html/

# Document that the service listens on port 80
EXPOSE 80
