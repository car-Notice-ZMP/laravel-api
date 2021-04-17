FROM php:8.0.2-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        cron \
        curl \
        unzip \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-install pdo_mysql \
        && docker-php-ext-install mysqli \
        && docker-php-ext-install mbstring \
        && docker-php-ext-install zip \
        && docker-php-source delete
        COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
        RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
        RUN chown -R www-data:www-data /var/www/html \
            && a2enmod rewrite
            COPY crontab /etc/cron.d/crontab
            RUN chmod 0644 /etc/cron.d/crontab
            RUN crontab /etc/cron.d/crontab
            RUN touch /var/log/cron.log
            RUN docker-php-ext-configure mbstring
            RUN docker-php-ext-install mbstring
            RUN docker-php-ext-enable mbstring
            RUN echo "file_uploads = On\n" \
                "memory_limit = 500M\n" \
                "upload_max_filesize = 500M\n" \
                "post_max_size = 500M\n" \
                "max_execution_time = 600\n" \
                > /usr/local/etc/php/conf.d/uploads.ini
            COPY ./startup.sh /
            RUN chmod +x /startup.sh


FROM jenkins/jenkins:lts

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        docker.io \

        RUN chown -R www-data:www-data /var/www/html 
        RUN usermod -aG docker jenkins
        RUN chmod 777 /var/run/docker.sock


