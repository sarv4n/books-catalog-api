# books-catalog-api
Quality-Profiency Assessment

Чтобы поднять проект запустите команды в следующем порядке:

 make build

 composer install (отказываемся от автогенерации докер-контейнера БД для doctrine) 

 make up

Переходим в php-fpm 
 php bin/console doctrine-migration-migrate
