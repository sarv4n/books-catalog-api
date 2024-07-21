FROM php:8.2-fpm

# Устанавливаем утилиты для работы с PostgreSQL и Xdebug для отладки
RUN apt-get update \
    && apt-get install -y libpq-dev libzip-dev zip git\
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo pdo_pgsql exif zip

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Копируем файлы проекта
COPY . /var/www/html/

# Устанавливаем права на папку проекта
RUN chown -R www-data:www-data /var/www/html/

# Создаем пользователя и группу
RUN groupadd -r myuser && useradd -r -g myuser -m myuser

# Переходим на нового пользователя
USER myuser

# Открываем порты
EXPOSE 9000

# Запускаем команду для запуска сервера
CMD ["php-fpm"]
