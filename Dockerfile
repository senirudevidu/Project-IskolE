# Use official PHP image with Apache pinned by digest to use local cache without registry DNS
FROM php@sha256:d93c97a06be92aedd643d20f2b9d62f36075965323c74ee55121ea1b992ccb04

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