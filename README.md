
# Laravel Domains

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pushberryfinn/laravel-domains.svg)](https://packagist.org/packages/pushberryfinn/laravel-domains)
[![Tests](https://github.com/pushberryfinn/laravel-domains/actions/workflows/tests.yml/badge.svg)](https://github.com/pushberryfinn/laravel-domains/actions/workflows/tests.yml)
[![License](https://img.shields.io/packagist/l/pushberryfinn/laravel-domains.svg)](https://packagist.org/packages/pushberryfinn/laravel-domains)
[![PHP Version](https://img.shields.io/packagist/php-v/pushberryfinn/laravel-domains.svg)](https://packagist.org/packages/pushberryfinn/laravel-domains)

A Laravel package to manage and create modular domains inside your Laravel app.

## Overview

This package helps you organise your Laravel application by grouping related code (models, controllers, migrations, routes, commands, etc.) into **domains** — self-contained folders under `app/Domains`. Routes, migrations, and commands are automatically discovered and loaded for each domain.

---

## Requirements

- PHP 8.2 or higher
- Laravel 11.x

---

## Installation

```bash
composer require pushberryfinn/laravel-domains
```

Optionally publish the config file:

```bash
php artisan vendor:publish --tag=laravel-domains-config
```

---

## Usage

### Create a domain

```bash
php artisan domain:make Doctors
```

This creates the following structure under `app/Domains`:

```
app/Domains/
├── DomainsServiceProvider.php   ← created once on first domain
└── Doctors/
    ├── Console/Commands/
    ├── Http/Controllers/
    ├── Http/Requests/
    ├── Models/
    ├── database/migrations/
    └── routes/api.php
```

> **Important:** After running `domain:make` for the first time, register `DomainsServiceProvider` in `bootstrap/providers.php`:
>
> ```php
> return [
>     App\Providers\AppServiceProvider::class,
>     App\Domains\DomainsServiceProvider::class,
> ];
> ```

---

### Generate domain resources

```bash
# Model
php artisan domain:make-model Doctor --domain=Doctors

# Controller
php artisan domain:make-controller DoctorController --domain=Doctors

# Form Request
php artisan domain:make-request StoreDoctorRequest --domain=Doctors

# Migration
php artisan domain:make-migration create_doctors_table --domain=Doctors

# Artisan command
php artisan domain:make-command SyncDoctors --domain=Doctors
```

---

## How it works

- Every folder inside `app/Domains` is treated as a domain.
- `DomainsServiceProvider` (placed in `app/Domains`) automatically loads each domain's migrations, routes, and console commands.
- Console commands placed in `{Domain}/Console/Commands/` are auto-registered.

---

## Facade

You can use the `LaravelDomains` facade to list all registered domains at runtime:

```php
use LaravelDomains;

$domains = LaravelDomains::domains(); // ['Doctors', 'Patients', ...]
```

---

## License

The MIT License (MIT). See the [LICENSE](LICENSE.md) file for details.

---

## Author

Atdhe Krasniqi — [GitHub](https://github.com/pushberryfinn)
