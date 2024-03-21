FROM php:8.0.19-apache

# Instalaciones
RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    autoconf \
    pkg-config \
    libzip-dev \
    zlib1g-dev \
    libssl-dev \
    libssl-doc \
    libsasl2-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    ca-certificates

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Activo mod_rewrite 
RUN a2enmod rewrite

# Instalación de extensiones
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Configure Apache DocumentRoot to point to Laravel's public directory
# and update Apache configuration files
# Configuro unas variables
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copio el código de la aplicación
COPY ./back /var/www/html

# Establezco directorio de trabajo
WORKDIR /var/www/html

RUN rm -rf /var/www/html/vendor
RUN rm -rf /var/www/html/composer.lock

# Instalar composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Establecer la variable de entorno COMPOSER_ALLOW_SUPERUSER en true
ENV COMPOSER_ALLOW_SUPERUSER=1

# Ejecutar composer install
RUN composer install --no-interaction --no-scripts

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copias configuracion de vhost
COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copiar archivo de entorno
COPY ./back/.env /var/www/html/.env

# Exponer el puerto 8080
EXPOSE 8080