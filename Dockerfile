FROM php:8.0-apache

# Update package manager and install required libraries
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libonig-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libxslt-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        curl \
        mbstring \
        zip \
        intl \
        bcmath \
        gd \
        xsl

# Copy your application files
COPY . /var/www/html/

# Set permissions for the application files
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite (optional)
RUN a2enmod rewrite
