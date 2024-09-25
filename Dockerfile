FROM php:8.2-cli-alpine
WORKDIR /var/www

RUN apk add --no-cache linux-headers
RUN apk update \
    && apk add git curl nano $PHPIZE_DEPS libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-configure zip \
    && docker-php-ext-enable zip


COPY . /var/www
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

CMD ["composer", "start"]
