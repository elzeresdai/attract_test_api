
db name = attract_test

1.запустить миграции
php artisan migrate
2.запустить сиды
php artisan db:seed

oauth авторизация реализована с использованием Laravel Passport

Регистрация: POST URL:http://localhost:8000/api/register
'name' 
'email'
'password'
'c_password'

Авторизация: POST URL:http://localhost:8000/api/login
'email'
'password'

Список юзеров: GET URL:http://localhost:8000/api/users

Написать сообщение: POST URL:http://localhost:8000/api/messages
'message'
'to_user_id'

Посмотреть собщения от пользователя: GET URL:http://localhost:8000/api/messages/id
