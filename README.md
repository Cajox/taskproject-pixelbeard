## Installation

* [Laravel 11.x](https://laravel.com/docs/11.x/installation)

Clone Repository
  ```
  $ git clone https://github.com/Cajox/taskproject-pixelbeard.git
  ```
Install Laravel packages
  ```
  $ composer install
  ```
Create MySQL databases "pixelbeard" and "unittest_db"

Duplicate .env.example, rename duplicated file to .env and change credentials for DB.

Generate Application Key
  ```
  $ php artisan key:generate
  ```
Migrate Database Migration with seeder
  ```
  $ php artisan migrate --seed
  ```
Start Server
  ```
  $ php artisan serve
  ```

## API Doc

Generate api doc | Visit Url: http://127.0.0.1:8000/docs#endpoints
  ```
  $ php artisan scribe:generate
  ```

