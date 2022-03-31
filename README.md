# BURGIZZA

 ## Запуск проекта 

#### Установка композера для докера, шобы ошибок не было

`$ docker run --rm -v $(pwd):/app composer install `

#### Установка пользователя 

`$ sudo chown -R $USER:$USER ~/BURGIZZA`

#### Ну и финалочка 
 
`$ docker-compose up -d`
