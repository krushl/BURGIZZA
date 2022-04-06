# BURGIZZA

 ## Запуск проекта 
 
* #### 1. Для начала надо за гит-клонить проект

* #### 2. Установка композера в докер, шобы ошибок не было

        `$ docker run --rm -v $(pwd):/app composer install `

* #### 3. Установка пользователя 

        `$ sudo chown -R $USER:$USER ~/BURGIZZA`

* #### 4. Ну и финалочка 
 
        `$ docker-compose up -d`

## URL
* Сам сайт   
   ` localhost:8080 `
* Админер для просмотра бд   
            ` localhost:8081`  
            
    База, cервер, логин, пароль брать из `.env`  
    По-умолчанию:
    ```.env
        DB_CONNECTION=pgsql  //System
        DB_HOST=burgizza-db  //Server
        DB_DATABASE=burgizza //Database
        DB_USERNAME=root     //Login
        DB_PASSWORD=root     //Password
     ```
  
## Errors

Если вылазит ошибка по порту, чтото типо такого:
>Error starting userland proxy: listen tcp4 0.0.0.0:80: bind: address already in use

То сначало нужно проверить, что за гадость заняла 80 порт  
>   $ sudo lsof -i -P -n 

Потом когда нашли виновника, надо его оставить

> $ sudo service name_service stop

`name_service` - имя сервиса который занял 80 порт, к примеру `apache2`
