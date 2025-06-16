# Use the official PHP 8.2 FPM image as base
FROM php:8.2-fpm

# Install PostgreSQL PHP extension
# Update package lists
# Install libpq-dev which provides the necessary libraries for PostgreSQL client
# Install the pdo_pgsql PHP extension
# Clean up apt caches to reduce image size
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set the working directory inside the container
WORKDIR /var/www/html

# You can add any other PHP extensions or configurations here if needed
# For example, to install other common extensions:
# RUN docker-php-ext-install mbstring opcache
