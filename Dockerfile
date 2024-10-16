# syntax=docker/dockerfile:1

# Create a stage for installing app dependencies defined in Composer.
FROM composer:lts as deps

WORKDIR /app

# Copy the composer.json and composer.lock to install dependencies
COPY composer.json composer.lock ./

# Download dependencies as a separate step to take advantage of Docker's caching.
RUN --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

################################################################################

# Create a new stage for running the application that contains the minimal
# runtime dependencies for the application.
FROM php:8.2-apache as final

# Install additional PHP extensions if needed (uncomment if necessary)
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Use the default production configuration for PHP runtime arguments
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy the app dependencies from the previous install stage.
COPY --from=deps /app/vendor /var/www/html/vendor
# Copy the application files from the app directory.
COPY . /var/www/html

# Set proper permissions for storage and bootstrap/cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Switch to a non-privileged user that the app will run under
USER www-data

# Expose port 80 for the web server
EXPOSE 80
