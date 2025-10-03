FROM php:8.3-cli

RUN apt-get update && \
    apt-get install -y git unzip libzip-dev && \
    docker-php-ext-install zip

COPY --from=mlocati/php-extension-installer \
    /usr/bin/install-php-extensions \
    /usr/bin

COPY --from=composer:latest \
    /usr/bin/composer \
    /usr/bin/composer

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN groupadd -g ${GROUP_ID} developer && \
    useradd -u ${USER_ID} -g developer -s /bin/sh -m developer && \
    mkdir /app && chown developer:developer /app

USER developer

WORKDIR /app

ENTRYPOINT [ "composer" ]

CMD [ "list" ]
