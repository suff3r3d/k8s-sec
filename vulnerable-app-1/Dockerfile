FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    vim \
    curl \
    procps \
    net-tools \
    iputils-ping \
    inotify-tools \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY apache.conf /etc/apache2/sites-available/000-default.conf

COPY app/ /var/www/html/

RUN mkdir -p /var/www/uploads && \
    chmod -R 777 /var/www/uploads

WORKDIR /var/www/html

EXPOSE 80
