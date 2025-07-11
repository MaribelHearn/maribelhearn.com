FROM httpd:2.4

# Install required packages and enable Apache modules
USER root
RUN <<EOF
apt-get -qq update
apt-get -q -y upgrade
apt-get install -y sudo curl wget nano locales
rm -rf /var/lib/apt/lists/*
EOF

# Copy over the Apache virtual host
COPY ./apache.conf /usr/local/apache2/conf/extra/

# Set up main Apache configuration
RUN <<EOF
chown -R 1000:1000 /usr/local/apache2/logs
mv /usr/local/apache2/conf/extra/apache.conf /usr/local/apache2/conf/extra/mh.conf
echo ServerTokens ProductOnly >> /usr/local/apache2/conf/httpd.conf
echo ServerSignature Off >> /usr/local/apache2/conf/httpd.conf
echo TraceEnable Off >> /usr/local/apache2/conf/httpd.conf
echo Protocols h2 h2c http/1.1 >> /usr/local/apache2/conf/httpd.conf
echo ServerName localhost >> /usr/local/apache2/conf/httpd.conf
echo Include conf/extra/mh.conf >> /usr/local/apache2/conf/httpd.conf
sed -i 's,#\(LoadModule expires_module modules/mod_expires.so\),\1,g'
sed -i 's,#\(LoadModule rewrite_module modules/mod_rewrite.so\),\1,g'
sed -i 's,#\(LoadModule proxy_module modules/mod_proxy.so\),\1,g'
sed -i 's,#\(LoadModule proxy_fcgi_module modules/mod_proxy_fcgi.so\),\1,g'
echo "<Directory /var/www/maribelhearn.com>" >> /usr/local/apache2/conf/httpd.conf
echo   Options -Indexes -MultiViews +FollowSymLinks >> /usr/local/apache2/conf/httpd.conf
echo   AllowOverride None >> /usr/local/apache2/conf/httpd.conf
echo   Require all granted >> /usr/local/apache2/conf/httpd.conf
echo "</Directory>" >> /usr/local/apache2/conf/httpd.conf
EOF

# Setup an app user so the container doesn't run as the root user
USER 1000

# Apache variables and language setting
ENV APACHE_DOCUMENT_ROOT=/var/www/maribelhearn.com
ENV LANG=en_US.UTF-8

# Set the working directory
WORKDIR /var/www/maribelhearn.com
