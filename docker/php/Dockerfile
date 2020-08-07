# Основываемся на контейнере версии 7.2-fpm
FROM php:7.2-fpm

# Устанавливаем необходимые для расширений пакеты
RUN apt-get update && apt-get install -y \
        zip unzip \
        --no-install-recommends

# Устанавливаем vim и git
RUN apt-get update && apt-get install -y \
    git-core

# удаляем папку с конфигами по умолчанию для php-fpm
RUN rm -rf /usr/local/etc/php-fpm.d
# копируем конфиги из папки с проектов в контейнер
COPY ./pools /usr/local/etc/php-fpm.d
COPY ./php.ini /usr/local/etc/php/
COPY ./php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./docker-php-entrypoint /usr/local/bin/

# устанавливаем composer в контейнер
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/bin
CMD bash -c "composer install"

ENTRYPOINT ["docker-php-entrypoint"]
CMD ["php-fpm"]