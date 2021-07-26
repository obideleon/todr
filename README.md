# Todr

Todr is a Todo App API made with Laravel Lumen.

## Lumen

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Todr API Documentation

For the documentation of this API please visit [Todr Documentation](https://documenter.getpostman.com/view/14056641/TzsbK7JM)

## How to use this project

To install dependencies type this command:

```
composer install
```

Rename `.env.example` to `.env`

Modify database information in `.env`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Generate App Key with this command:

```
php artisan key:generate
```

Generate Secret Key for JWT with this command:

```
php artisan jwt:secret
```

Migrate database table with this command:

```
php artisan migrate
```

To run the server run this command:

```
php artisan serve
```
