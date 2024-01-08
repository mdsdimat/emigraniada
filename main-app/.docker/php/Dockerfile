FROM php:8.2-cli-alpine3.17 as app_php

RUN --mount=type=bind,from=mlocati/php-extension-installer:1.5,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
    apk update \
    && apk add --no-cache \
        bash \
        ${PHPIZE_DEPS} \
        grpc-dev \
    && rm -rf /var/lib/apt/lists/* && \
    install-php-extensions opcache zip xsl dom exif intl pcntl bcmath sockets pgsql pdo_pgsql grpc && \
    apk del --no-cache ${PHPIZE_DEPS} ${BUILD_DEPENDS} && \
    wget -q "https://github.com/aptible/supercronic/releases/download/v0.2.1/supercronic-linux-arm64" \
        -O /usr/bin/supercronic \
    && chmod +x /usr/bin/supercronic \
    && mkdir /etc/supercronic \
    && echo '*/1 * * * * php /app/app.php cron-task foo --times=20' > /etc/supercronic/emg-main

WORKDIR /app

ARG UID=1000
ARG GID=1000

RUN addgroup -g ${GID} -S emg-main && adduser --uid ${UID} --ingroup emg-main -S -g emg-main emg-main && \
    mkdir -p /home/emg-main/Downloads /app \
    && chown -R emg-main:emg-main /home/emg-main \
    && chown -R emg-main:emg-main /app

USER emg-main

ENV COMPOSER_HOME="/tmp/composer"

COPY --chown=emg-main:emg-main --from=composer:2.3 /usr/bin/composer /usr/bin/composer
COPY --chown=emg-main:emg-main ./composer.* .

RUN composer config --no-plugins allow-plugins.spiral/composer-publish-plugin false && \
    composer install --no-cache --no-ansi --no-autoloader --no-scripts --no-dev

COPY --chown=emg-main:emg-main --from=spiralscout/roadrunner:2.10.7 /usr/bin/rr /app

COPY --chown=emg-main:emg-main ./ .

RUN set -x \
    && composer dump-autoload -n --optimize \
    && chmod -R 777 ${COMPOSER_HOME}/cache \
    && php app.php configure

FROM app_php as app_php_dev
USER root
RUN --mount=type=bind,from=mlocati/php-extension-installer:1.5,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions \
    install-php-extensions xdebug && \
    apk del --no-cache ${PHPIZE_DEPS} ${BUILD_DEPENDS}

COPY .docker/php/config/dev.ini /usr/local/etc/php/conf.d/

USER emg-main

FROM app_php as app_php_prod
USER root
COPY .docker/php/config/prod.ini /usr/local/etc/php/conf.d/
USER emg-main
