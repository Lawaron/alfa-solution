FROM php:8.3-cli AS base

RUN apt-get update && \
    apt-get install -y git unzip libzip-dev && \
    docker-php-ext-install zip

COPY --from=mlocati/php-extension-installer \
    /usr/bin/install-php-extensions \
    /usr/bin

RUN install-php-extensions \
    xdebug

COPY --from=composer:latest \
    /usr/bin/composer \
    /usr/bin/composer

ENTRYPOINT [ "composer" ]

CMD [ "list" ]

FROM base AS build

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY . .

FROM base AS dev

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN groupadd -g ${GROUP_ID} developer && \
    useradd -u ${USER_ID} -g developer -s /bin/sh -m developer && \
    mkdir /app && chown developer:developer /app

USER developer

WORKDIR /app
