# Chirper

Homework for [Pannon Set Kft](https://www.ps.hu/)

## Install
Requirements
- PHP 8.3
- Composer
- PHP MySQL extension
```bash
npm install
composer update
```
## Setup
```bash
cp .env.example .env
```
Edit .env file and set app_key, db and files backup_path environment variables.
```ini
APP_KEY=base64:[YOUR_APP_KEY]

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
