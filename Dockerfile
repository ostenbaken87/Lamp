FROM php:8.2-apache

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && a2enmod rewrite headers \
    && echo "ServerTokens Prod" >> /etc/apache2/conf-available/security.conf \
    && echo "ServerSignature Off" >> /etc/apache2/conf-available/security.conf \
    && a2enconf security \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Копируем конфиги
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
EXPOSE 80