FROM alpine:3.18

RUN apk add --update --no-cache \
    coreutils \
    php82 \
    php82-dev \
    php82-common \
    php82-curl \
    php82-pdo \
    libpq \
    php82-pdo_pgsql \
    php82-pcntl \
    php82-phar \
    php82-zip \
    php82-zlib \
    php82-fpm \
    php82-tokenizer \
    php82-xdebug \
    php82-openssl \
    php82-mbstring \
    php82-iconv \
    php82-ctype \
    php82-simplexml \
    php82-xml \
    php82-tokenizer \
    php82-session \
    php82-dom \
    php82-xmlwriter \
    make \
    curl \
    shadow

# create php symlink
RUN mv /usr/bin/php82 /usr/bin/php

RUN echo "$(curl -sS https://composer.github.io/installer.sig) -" > composer-setup.php.sig \
        && curl -sS https://getcomposer.org/installer | tee composer-setup.php | sha384sum -c composer-setup.php.sig \
        && php composer-setup.php && rm composer-setup.php* \
        && chmod +x composer.phar && mv composer.phar /usr/bin/composer

RUN adduser -u 1000 -G www-data -s /bin/sh -D www-data
RUN groupmod -g 1000 www-data

COPY php.ini /etc/php82/conf.d/
COPY php.ini /etc/php82/cli/conf.d/
COPY xdebug.ini  /etc/php82/conf.d/

COPY www.conf /etc/php82/php-fpm.d/

RUN mkdir -p /var/www
RUN chown -R www-data:www-data /var/www

# RabbitMQ required stack
RUN apk add --update --no-cache \
    autoconf \
    build-base \
    rabbitmq-c-dev \
    php82-sockets \
    git

RUN git clone https://github.com/php-amqp/php-amqp.git
WORKDIR /php-amqp
RUN phpize82 && \
    ./configure --with-php-config=/usr/bin/php-config82 && \
    make && \
    make install

CMD ["php-fpm82", "-F"]

WORKDIR /var/www/symfony
EXPOSE 3000