# Changelog

All notable changes to this project will be documented in this file.

## [1.1.0] - 2026-05-09

### Added
- New `domain:make-command` artisan command to scaffold Artisan commands inside a domain.
- `LaravelDomains::domains()` method (and facade) to list registered domains at runtime.
- Config file (`config/laravel-domains.php`) with `path` and `namespace` keys.
- PHPUnit test suite with Feature and Unit tests.
- GitHub Actions CI workflow (PHP 8.2 and 8.3).
- `CONTRIBUTING.md`, issue templates, and pull request template.
- `.gitignore` and `pint.json`.

### Fixed
- `domain:make` now creates `Http/Controllers` and `Http/Requests` instead of a bare `Controllers` folder, matching where `domain:make-controller` and `domain:make-request` actually write files.
- `MakeDomainModelCommand` now uses the `$rootNamespace` parameter instead of hardcoding `App`, matching all other commands.
- `LaravelDomainsFacade` was broken (unbound container key); service provider now properly binds `laravel-domains` to the container.
- `require-dev` versions updated to `orchestra/testbench ^9.0` and `phpunit/phpunit ^11.0` to match the declared Laravel 11 requirement.
- README corrected: PHP 8.2+ and Laravel 11 (was incorrectly documenting PHP 7.4 / Laravel 8).

## [1.0.0] - 2025-06-08

### Added
- Initial release of `pushberryfinn/laravel-domains` package.
- Command `domain:make` to create a new domain folder with service provider, routes, and folder structure.
- Commands to generate domain-scoped models, controllers, migrations, and console commands.
- Automatic discovery and registration of routes, migrations, and commands within each domain.
- Auto-registration of console commands located inside domain folders.
- Basic stub files for domain scaffolding.
