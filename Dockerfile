# This Dockerfile uses multi-stage and needs Docker 17.09 at least to work

# First stage uses the default composer image to run `composer install`
FROM composer:1.9 as composer
ARG APP_VERSION="v1"

WORKDIR /app
COPY . /app

ENV COMPOSER_ALLOW_SUPERUSER 1

# Second and final stage to run nginx and php-fpm
# Use alpine linux as a base
FROM alpine:3.10
ARG xdebug=1
ARG environment="mac"

RUN apk update
RUN apk add nginx py-pip shadow php7 php7-fpm php7-intl php7-curl php7-mbstring php7-apcu php7-soap php7-opcache php7-ctype php7-dom php7-iconv php7-json php7-xml php7-tokenizer php7-pdo php7-pdo_pgsql php7-pgsql
RUN pip install supervisor
# tweak OPcache to improve performance
RUN echo $' \n\
opcache.huge_code_pages=1 \n\
opcache.revalidate_freq=0 \n\
opcache.validate_timestamps=1 \n\
opcache.max_accelerated_files=7963 \n\
opcache.memory_consumption=192 \n\
opcache.interned_strings_buffer=16 \n\
' >> /etc/php7/conf.d/00_opcache.ini
# enable xdebug for local env
RUN if [ "$xdebug" = "1" ] ; then \
    apk add php7-xdebug \
    && echo $' \n\
zend_extension=xdebug.so \n\
xdebug.remote_enable = 1 \n\
xdebug.idekey = PHPSTORM \n\
xdebug.overload_var_dump = 0 \n\
' >> /etc/php7/conf.d/xdebug.ini; fi

RUN if [ "$xdebug" = "1" ] && [ "$environment" = "mac" ]; then \
echo $' \n\
xdebug.remote_connect_back = 0 \n\
xdebug.remote_host = "host.docker.internal" \n\
' >> /etc/php7/conf.d/xdebug.ini; else \
echo $' \n\
xdebug.remote_connect_back = 1 \n\
' >> /etc/php7/conf.d/xdebug.ini; fi

# clean the image
RUN rm -rf /var/cache/apk/*

# Set the working directory to /app
WORKDIR /app

# useful for local development assuming your host is linux and your local user id is 1000
RUN usermod -u 1000 nginx

# Copy the current directory contents into the container at /app
COPY --from=composer /app /app

# remove (symlink not used anyway)/create (in case missing locally) relevant files so that chown does not fail
# chown relevant files to nginx user (jms-serializer, nginx)
RUN rm /var/lib/nginx/run \
    && mkdir -p /app/var \
    && chown nginx:nginx -RfL /app/var /var/lib/nginx/

# PHP logs
RUN mkfifo /tmp/stdout && chmod 777 /tmp/stdout


# Copy configuration files
COPY .docker/nginx-vhosts.conf /etc/nginx/nginx.conf
COPY .docker/php-fpm-docker.conf /etc/php7/php-fpm-docker.conf
COPY .docker/supervisord.conf /etc/supervisord.conf

# Make port 80 available to the world outside this container
EXPOSE 80

# Run nginx and php-fpm via supervisord
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
