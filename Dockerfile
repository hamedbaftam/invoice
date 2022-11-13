FROM php:8.1-fpm

RUN apt-get update && apt-get install
# Copy composer.lock and composer.json
#COPY ./Presentation/composer.lock ./Presentation/composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update --allow-releaseinfo-change && apt-get install -y \
        iputils-ping \
        build-essential \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        locales \
        jpegoptim optipng pngquant gifsicle \
        vim \
        zip \
        unzip \
        git \
        curl \
        zlib1g-dev \
        libzip-dev
#RUN  apt install php-bcmath
# Add and Enable PHP-PDO Extenstions
RUN apt-get install --no-install-recommends -y libpq-dev libxslt-dev libcurl4-openssl-dev pkg-config postgresql-client iputils-ping \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql curl gd xsl zip bcmath opcache

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN printf "\n \n" | pecl install redis && docker-php-ext-enable redis



# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www
ENV PHP_EXTRA_CONFIGURE_ARGS --enable-fpm --with-fpm-user=www --with-fpm-group=www


RUN #cp docker/www.conf /usr/local/etc/php-fpm.d/www.conf

#RUN composer dumpautoload


# Copy existing application directory permissions
COPY --chown=www:www . /var/www
RUN chmod -R 777 /var/www
RUN  #chown -R 777 /var/www/composer.lock

RUN chown -R www:www /var/www

# Change current user to www
USER www

#RUN php artisan optimize
#RUN php artisan migrate

EXPOSE 9000
CMD ["php-fpm"]
