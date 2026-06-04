FROM php:8.2-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (useful for routing/htaccess)
RUN a2enmod rewrite

# Copy project files to Apache document root
COPY . /var/www/html/

# Ensure proper permissions for Apache
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
