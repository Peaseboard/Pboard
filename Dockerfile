FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \n    libpng-dev \n    libjpeg-dev \n    libfreetype6-dev \n    libzip-dev \n    zip \n    unzip \n    git \n    curl \n    libonig-dev \n    && docker-php-ext-configure gd --with-freetype --with-jpeg \n    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["php-fpm"]
