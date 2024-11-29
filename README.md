# Chirper

Homework for [Pannon Set Kft](https://www.ps.hu/)

## Install
```bash
npm install
```
## Setup
```bash
cp .env.example .env
```
Edit .env file and set database and file upload path.
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=[USERNAME]
DB_PASSWORD=[PASSWORD]

BACKUP_PATH="/tmp/laravel/"
```
Migrate database
```bash
php artisan migrate
```
## Run
```bash
# react server
npm run dev &
# laravel server
php artisan serve &
```

## Browser
Open [http://localhost:8000/](http://localhost:8000/)
