# books-catalog-api
Quality-Profiency Assessment

Чтобы поднять проект запустите команды в следующем порядке:

 make build

 composer install (отказываемся от автогенерации докер-контейнера БД для doctrine) 

 make up

Переходим в php-fpm 
 php bin/console doctrine-migration-migrate


# Нюансы:
# POST запросы
Для тела запроса при POST запросах используйте form-data формат.
Для дат используем формат Y-m-d H:i:s

# GET запросы
Для GET запросов, все как обычно.

