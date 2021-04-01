FROM php:7.4.1-fpm

RUN  apt-get update && apt-get install -y \
    apt-utils \
    openssl \
    git \
    unzip \
    curl \
    wget \
    gnupg \
    libmagickwand-dev

RUN echo "deb http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
RUN echo "deb-src http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
RUN curl -sS --insecure https://www.dotdeb.org/dotdeb.gpg | apt-key add -

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

RUN echo "upload_max_filesize = 50M\n" \
         "post_max_size = 50M\n" \
         > /usr/local/etc/php/conf.d/uploadsconf.ini

RUN echo "extension=imagick.so\n" \
         > /usr/local/etc/php/conf.d/imagick.ini

RUN docker-php-ext-install pdo pdo_mysql \
    && pecl install apcu-5.1.18 \
    && pecl install imagick \
    && docker-php-ext-enable apcu \
    && docker-php-ext-install opcache\
    && docker-php-ext-install zip

WORKDIR /var/www/htdocs

