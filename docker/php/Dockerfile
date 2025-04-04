FROM php:8.2-fpm

# Configurar repositorios y actualizar
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    librabbitmq-dev \
    libssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install \
    intl \
    zip \
    pdo \
    pdo_mysql \
    gd \
    opcache

# Instalar APCU
RUN pecl install apcu && docker-php-ext-enable apcu

# Instalar PCOV
RUN pecl install pcov && docker-php-ext-enable pcov

# Instalar AMQP (versión específica y con configuración adicional)
RUN pecl config-set preferred_state beta \
    && pecl install amqp-1.11.0 \
    && docker-php-ext-enable amqp \
    && pecl config-set preferred_state stable

# Instalar Redis
RUN pecl install redis && docker-php-ext-enable redis

# Instalar Xdebug con versión específica
RUN pecl install xdebug-3.2.1 && docker-php-ext-enable xdebug

# Configurar Xdebug
RUN echo "xdebug.mode=develop,debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD ["php-fpm"]