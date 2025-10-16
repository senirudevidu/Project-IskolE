# Use official PHP image with Apache
FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable mysqli extension
RUN docker-php-ext-enable mysqli

# Copy PHP app into Apache's document root
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for web traffic
EXPOSE 80

# Start Apache in foreground (default command)
CMD ["apache2-foreground"]