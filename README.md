# Инструкции по запуску
Для первого запуска скопируйте в терминал следующее:
```shell
git clone https://github.com/rexxless/koteika.git
cd koteika/project
cp .env.example .env # Если будет необходимо внести изменения в окружение, редактируйте файл .env (Не .env-example)!
cd ../deploy
ln -s ../project/.env .env
docker compose up -d --build
docker compose exec backend composer install 
```

Для запуска миграций и заполнения БД тестовыми данными скопируйте в терминал следующее:
```shell
docker compose exec backend php artisan migrate
docker compose exec backend php artisan db:seed
```

Для всех последующих запусков достаточно скопировать в терминал следующее:
```shell
cd koteika/deploy
docker compose up -d
```
