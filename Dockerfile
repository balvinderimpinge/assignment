FROM php:8.0-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy your application files
COPY . /var/www/html/

# Set permissions for the application files
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite (optional)
RUN a2enmod rewrite
