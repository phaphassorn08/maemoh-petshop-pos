# Maemoh Petshop - POS

## Screenshots

![preview img](/photo/dashboard.jpg)
![preview img](/photo/product.jpg)
![preview img](/photo/pos.jpg)


## Run Locally

Go to the project directory

```bash
  cd project-name
```

-   Copy example.env file to .env and edit database credentials there

```bash
    create database in xampp : ecommerce
```

```bash
    composer install
```

```bash
    php artisan key:generate
```

```bash
    php artisan storage:link
```

```bash
    php artisan migrate:fresh --seed
```

```bash
    php artisan serve
```

```bash
    Starting Laravel development server: http://127.0.0.1:8000
```

#### Login

-   email = admin@example.com
-   password = 123
#
