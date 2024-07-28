FROM php:8.0-cli

# Install system dependencies
RUN apt-get update && apt-get install -y git zip unzip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /app

# Copy project files
COPY . /app

# Install PHP dependencies
RUN composer install

# Run PHPStan analysis
RUN vendor/bin/phpstan analyse -c phpstan.neon

# Run PHPUnit tests
RUN vendor/bin/phpunit

CMD ["php", "index.php"]
