# Use the official PHP image as the base image
FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    vim \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Set permissions for storage and cache directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader -vvv || { echo 'composer install failed'; exit 1; }

# Clear cache
RUN php artisan optimize:clear || { echo 'artisan optimize:clear failed'; exit 1; }

# Link storage
RUN php artisan storage:link || { echo 'artisan storage:link failed'; exit 1; }

# Ensure database connection is configured before running migrations
RUN if [ -f .env ]; then echo ".env file exists"; else echo ".env file missing"; fi

# Run database migrations
RUN php artisan migrate --force || { echo 'artisan migrate failed'; exit 1; }

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
