* ### Клонируем репозиторий:
*git clone git@github.com:DimaKuptsov/visiting-statistic.git*

* ### Заполняем переменные окружения docker (.env)

* ### Заполняем переменные окружения PHP (visiting-statistic/.env)

* ### Поднимаем контейнеры:
*docker-compose up --build*

* ### Заходим в контейнер PHP
*docker exec -ti php_visiting bash*

* ### Устанавливаем зависимости
*composer install*

* ### Накатываем миграции
*php artisan migrate*