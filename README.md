
# Laravel Domains

A Laravel package to manage and create modular domains inside your Laravel app.

## Overview

This package helps you organize your Laravel application by grouping related code (models, controllers, migrations, routes, commands, etc.) into **domains** — folders inside `app/Domains`. It supports automatic loading of routes, migrations, and commands per domain.

---

## Features

- Generate domain folders with a service provider, routes, and basic structure
- Artisan commands to create domain resources like models, controllers, and migrations inside the domain folder
- Automatic discovery of all domains under `app/Domains` and bootstrapping routes, migrations, and commands
- Command auto-registration inside each domain’s `Console/Commands` folder

---

## Installation

Require the package via composer:

```bash
composer require pushberryfinn/laravel-domains
```

Publish the package's service provider (if needed):

```bash
php artisan vendor:publish --provider="Pushberryfinn\LaravelDomains\LaravelDomainsServiceProvider"
```

---

## Usage

### Create a domain

```bash
php artisan domain:make Doctors
```

This will create:

- `app/Domains/Doctors`
- `DomainsServiceProvider.php` inside the domain folder
- A `routes/api.php` file
- The necessary folder structure for models, controllers, commands, migrations, etc.

### Generate domain resources

Example: Create a model inside the Doctors domain

```bash
php artisan domain:make-model Doctor --domain=Doctors
```

Similarly, you can create controllers, migrations, and commands scoped to your domain:

```bash
php artisan domain:make-controller DoctorController --domain=Doctors
php artisan domain:make-migration create_doctors_table --domain=Doctors
php artisan domain:make-command SyncDoctors --domain=Doctors
```

---

## How it works

- Your domains live inside `app/Domains`.
- The main `DomainsServiceProvider` automatically loads routes, migrations, and commands from each domain.
- Commands are auto-registered if placed inside the domain's `Console/Commands` directory.

---

## Requirements

- PHP 7.4 or higher
- Laravel 8.x

---

## License

The MIT License (MIT). See the [LICENSE](LICENSE) file for details.

---

## Author

Atdhe Krasniqi — [GitHub](https://github.com/pushberryfinn)