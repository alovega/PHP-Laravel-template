FROM php:8.2-fpm

# Install required dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libbz2-dev \
    libexif-dev \
    unzip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-install \
    gd \
    pdo_mysql \
    mysqli \
    exif \
    intl \
    bz2

# Clean up apt cache to reduce image size
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Set working directory (optional, depends on your project structure)
WORKDIR /var/www/html
