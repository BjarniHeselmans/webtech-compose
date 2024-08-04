# Use an official PHP image as a parent image
FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libxpm-dev \
    libfreetype6-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
	&& docker-php-ext-install mysqli

	# Clear cache
	RUN apt-get clean && rm -rf /var/lib/apt/lists/*
	
	# Set working directory
	WORKDIR /var/www/html
	
	# Copy existing application directory contents
	COPY . /var/www/html
	
	# Copy existing application directory permissions
	COPY --chown=www-data:www-data . /var/www/html
	
	# Expose port 9000 and start php-fpm server
	EXPOSE 9000
	CMD ["php-fpm"]