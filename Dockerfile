# Use an official PHP image with necessary extensions
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    curl \
    gnupg \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install PHP dependencies with Composer
RUN composer install --no-dev --optimize-autoloader

RUN php artisan storage:link

# Install Node.js dependencies
RUN npm install

# Install Laravel Vite plugin
RUN npm install vite laravel-vite-plugin

# Build frontend assets
RUN npm run build

# Create build directory and set permissions
RUN mkdir -p /var/www/public/build && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public/build && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/public/build

RUN php artisan key:generate


RUN mv /var/www/public/build/.vite/manifest.json /var/www/public/build

# Set permissions for manifest.json file
RUN chmod 775 /var/www/public/build/manifest.json

# Expose the port
EXPOSE 9000

CMD ["php-fpm"]
