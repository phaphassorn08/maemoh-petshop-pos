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

-   Copy .env.example file to .env and edit database credentials there

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

#### Login

-   email = admin@example.com
-   password = 123
#
