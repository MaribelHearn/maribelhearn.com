FROM php:8.4-apache

# Install required packages and enable Apache modules
USER root
RUN <<EOF
apt-get -qq update
apt-get -q -y upgrade
apt-get install -y sudo curl wget nano locales
rm -rf /var/lib/apt/lists/*
a2enmod rewrite headers expires proxy proxy_balancer proxy_fcgi proxy_http proxy_wstunnel
mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
EOF

# Copy over the Apache configuration
COPY ./apache.conf /etc/apache2/sites-available/
RUN <<EOF
mv /etc/apache2/sites-available/apache.conf /etc/apache2/sites-available/mh.conf
echo ServerTokens ProductOnly >> /etc/apache2/apache2.conf
echo ServerSignature Off >> /etc/apache2/apache2.conf
echo TraceEnable Off >> /etc/apache2/apache2.conf
echo Protocols h2 h2c http/1.1 >> /etc/apache2/apache2.conf
EOF

# Install locales
RUN <<EOF
echo 'en_US.UTF-8 UTF-8' >> /etc/locale.gen
echo 'en_GB.UTF-8 UTF-8' >> /etc/locale.gen
echo 'ja_JP.UTF-8 UTF-8' >> /etc/locale.gen
echo 'zh_CN.UTF-8 UTF-8' >> /etc/locale.gen
echo 'de_DE.UTF-8 UTF-8' >> /etc/locale.gen
echo 'ru_RU.UTF-8 UTF-8' >> /etc/locale.gen
echo 'es_ES.UTF-8 UTF-8' >> /etc/locale.gen
dpkg-reconfigure --frontend=noninteractive locales
EOF

# Install PHP modules
RUN docker-php-ext-install gettext

# Enable the website
RUN a2ensite mh
RUN a2dissite 000-default

# Setup an app user so the container doesn't run as the root user
USER 1000

# Apache variables and language setting
ENV APACHE_DOCUMENT_ROOT=/var/www/maribelhearn.com
ENV LANG=en_US.UTF-8

# Set the working directory
WORKDIR /var/www/maribelhearn.com
