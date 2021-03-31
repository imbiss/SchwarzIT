FROM php:7.4-apache

LABEL author="Hongyi Chen"
LABEL email="imbisschn@gmail.com"

RUN apt-get update \ 
    && apt-get install -y apt-utils \
    && apt-get install -qqy git unzip libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libaio1 libaio-dev wget \
    && apt-get clean autoclean \
    && apt-get autoremove --yes \
    && rm -rf /var/lib/{apt,dpkg,cache,log}/

# SOAP 
RUN apt-get install -y libxml2-dev && docker-php-ext-install soap

# CURL
RUN apt-get install -y libcurl4-gnutls-dev && docker-php-ext-install curl

# ZMQ
RUN apt-get -y install gcc make autoconf pkg-config
RUN apt-get install -y -qq libzmq3-dev
#RUN pecl7.0-sp install zmq-beta

# COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# HABILITA MODO REQRITE NO APACHE
RUN a2enmod rewrite

# XDEBUG
RUN curl -fsSL 'https://xdebug.org/files/xdebug-3.0.3.tgz' -o xdebug.tar.gz \
    && mkdir -p xdebug \
    && tar -xf xdebug.tar.gz -C xdebug --strip-components=1 \
    && rm xdebug.tar.gz \
    && ( \
    cd xdebug \
    && phpize \
    && ./configure --enable-xdebug \
    && make -j$(nproc) \
    && make install \
    && make test \	
    ) \
    && rm -r xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini

EXPOSE 9000  
RUN pecl install xdebug 

RUN echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN docker-php-ext-install mysqli \
    && docker-php-source delete 

# Install PHP mysql extension
RUN docker-php-ext-install pdo 
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install gd

#
# install OpCache and add config
#
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"
RUN docker-php-ext-install opcache
COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini

#
# cp php.ini
#

COPY ./php.ini /usr/local/etc/php/php.ini

# Apache
RUN rm /etc/apache2/sites-available/000-default.conf
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

# Symfony binary
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# node
ARG NODE_VERSION=14.16.0
ARG NODE_PACKAGE=node-v$NODE_VERSION-linux-x64
ARG NODE_HOME=/opt/$NODE_PACKAGE
ENV NODE_PATH $NODE_HOME/lib/node_modules
ENV PATH $NODE_HOME/bin:$PATH
RUN curl https://nodejs.org/dist/v$NODE_VERSION/$NODE_PACKAGE.tar.gz | tar -xzC /opt/ \
   && ln -s /opt/node-v14.16.0-linux-x64/bin/node /usr/local/bin/nodejs

# yarn
RUN npm install -g yarn

