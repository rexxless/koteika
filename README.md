# Инструкции по запуску
Для первого запуска скопируйте в терминал следующее:
```shell
git clone https://github.com/rexxless/koteika.git
cd koteika/backend
cp .env.example .env # Если будет необходимо внести изменения в окружение, редактируйте файл .env (Не .env-example)!
cd ../deploy
ln -s ../backend/.env .env
docker compose up -d --build
docker compose exec backend composer install
docker compose exec backend php artisan key:generate
docker compose exec backend php artisan migrate
```

Для заполнения БД тестовыми данными необходимо ввести следующую команду:
```shell
docker compose exec backend php artisan db:seed
```

Для всех последующих запусков достаточно скопировать в терминал следующее:
```shell
cd koteika/deploy
docker compose up -d
```

<h4>Проект можно открыть по ссылке <a href="http://localhost:80">http://localhost:80</a></h4>
