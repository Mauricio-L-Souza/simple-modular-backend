FROM php:8.2-cli

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupadd -g ${PGID} user && \
    useradd -l -u ${PUID} -g user -m user && \
    usermod -p "*" user -s /bin/bash

RUN apt update && apt-get upgrade -yqq && apt install -yqq --no-install-recommends \
    gettext \
    jq \
    rsyslog \
    rsyslog-gnutls \
    zlib1g \
    zlib1g-dev \
    apt-utils \
    gnupg \
    gosu \
    git \
    curl \
    wget \
    libcurl4-openssl-dev \
    ca-certificates \
    supervisor \
    libmemcached-dev \
    libz-dev \
    libbrotli-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libwebp-dev \
    libmcrypt-dev \
    libonig-dev \
    libzip-dev zip unzip \
    libargon2-1 \
    libidn2-0 \
    libpcre2-8-0 \
    libpcre3 \
    libxml2 \
    libzstd1 \
    procps \
    libbz2-dev

RUN docker-php-ext-install pdo pdo_pgsql bcmath calendar exif gettext shmop sockets sysvshm zip

RUN pecl install -o -f redis \
        && rm -rf /tmp/pear \
        && docker-php-ext-enable redis

RUN docker-php-ext-configure pcntl --enable-pcntl \
        && docker-php-ext-install pcntl

RUN apt-get install -yqq --no-install-recommends --show-progress libc-ares-dev
RUN pecl install -o -f -D 'enable-openssl="yes" enable-sockets="yes" enable-http2="yes" enable-swoole-curl="yes" enable-mysqlnd="yes" enable-cares="yes"' swoole
RUN docker-php-ext-enable swoole;
RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-install gd

RUN pecl install pcov
RUN docker-php-ext-enable pcov

RUN apt-get clean \
  && docker-php-source delete \
  && pecl clear-cache \
  && rm -R /tmp/pear \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
  && rm /var/log/lastlog /var/log/faillog

# composer
ENV COMPOSER_HOME /tmp
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer /usr/bin/composer /usr/bin/composer

# node
COPY --from=node:20-slim /usr/local/bin /usr/local/bin
# Get npm
COPY --from=node:20-slim /usr/local/lib/node_modules /usr/local/lib/node_modules

WORKDIR /usr/src/app

ADD entrypoint.sh /local/bin/entrypoint.sh

RUN chmod +x /local/bin/entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["/local/bin/entrypoint.sh"]
