FROM php:8.2-apache

SHELL ["/bin/bash", "-c"]

RUN apt-get update \
    && apt-get install -qq -y --no-install-recommends \
    cron \
    vim \
    locales coreutils apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev;


RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get -y install symfony-cli


RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo gd opcache intl zip calendar dom mbstring zip gd xsl && a2enmod rewrite
RUN pecl install apcu && docker-php-ext-enable apcu

RUN apt install -y unixodbc-dev
RUN pecl install sqlsrv
RUN pecl install pdo_sqlsrv
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv

RUN apt-get update \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list \
        > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get -y --no-install-recommends install \
        unixodbc-dev \
        msodbcsql17
    
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions amqp

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash \
    && apt-get install -y nodejs

COPY vhost.conf /etc/apache2/sites-available/000-default.conf

RUN groupadd -g 1000 symfony
RUN useradd -ms /bin/bash symfony -u 1000 -g 1000 -G sudo,root

WORKDIR /var/www