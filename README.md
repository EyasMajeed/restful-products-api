# RESTful Products API (Laravel 11)

A pragmatic REST API starter for products, categories, and inventory use cases — built on **Laravel 11**. Perfect base for e-commerce, catalogs, and internal tools.

> Requires **PHP ≥ 8.2** and Composer 2.x.

---

## Features

- Clean REST conventions (resource controllers, proper verbs, status codes)
- Eloquent models & migrations
- Form Request validation
- JSON API responses
- Pagination & filtering utilities
- Soft deletes 
- Authentication ready (Sanctum/JWT — add and document as needed)
- Testing scaffold (PHPUnit)

---

## Tech Stack

- **Laravel 11** (PHP framework)
- **PHP 8.2+**
- **MySQL / PostgreSQL / SQLite**
- **Composer**

---

## Quickstart

### 1) Clone
```bash
git clone https://github.com/EyasMajeed/restful-products-api.git
cd restful-products-api
```

### 2) Install
```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 3) Configure `.env`
Set your DB credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rest_api
DB_USERNAME=root
DB_PASSWORD=secret
```

### 4) Migrate (and seed if you add seeders)
```bash
php artisan migrate
# php artisan db:seed
```

### 5) Run
```bash
php artisan serve
# http://127.0.0.1:8000
```

---



