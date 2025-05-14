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
docker compose exec backend php artisan key:generate
docker compose exec backend php artisan migrate
```


Для всех последующих запусков достаточно скопировать в терминал следующее:
```shell
cd koteika/deploy
docker compose up -d
```
