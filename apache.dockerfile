# Use the official PHP image with Apache included
FROM php:7.4-apache

# Enable necessary Apache modules
RUN a2enmod rewrite

# Install required PHP extensions for database operations
RUN docker-php-ext-install pdo pdo_mysql

# Install GD extension with FreeType support
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Install Composer
RUN apt-get update && apt-get install -y wget zip unzip \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Install foxy/foxy with error handling
RUN composer global require foxy/foxy || echo "Error installing foxy/foxy, check compatibility!"

# Check Composer version and update if necessary
RUN composer --version

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs npm  # Ensure npm is also installed explicitly

# Verify Node.js and npm installation
RUN node -v && npm -v

# Set the proper permissions for the directory to be accessible by Apache
COPY ./yii01 /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Set up the Apache configuration file and add ServerName globally to suppress the warning
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Expose the default port
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
