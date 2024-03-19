FROM php:8.0.19-apache

RUN apt-get update

# Instalaciones
RUN apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++

# Configura Apache
RUN a2enmod rewrite

# Establece el directorio de trabajo
WORKDIR /var/www/back

# Copia el código fuente de Laravel al contenedor
COPY . /var/www/back

# instalar dependencias
RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    mbstring \
    pdo_mysql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cambia el propietario del directorio de Laravel
RUN chown -R www-data:www-data /var/www/back/storage

# Crea un enlace simbólico para el directorio public
RUN ln -s /var/www/back/public /var/www/html

COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# Exponer el puerto 80
EXPOSE 8080
