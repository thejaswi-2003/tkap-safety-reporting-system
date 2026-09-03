FROM php:8.2-apache

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (useful for clean URLs, safe to include)
RUN a2enmod rewrite

# Copy project files into Apache's web root
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Render provides the PORT env var; Apache needs to listen on it
RUN sed -i 's/80/${PORT:-80}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

EXPOSE 80

CMD ["apache2-foreground"]
