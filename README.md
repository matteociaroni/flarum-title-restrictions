# Title restrictions for Flarum

![License](https://img.shields.io/badge/license-MIT-blue.svg)

A [Flarum](http://flarum.org) extension to add some restrictions to titles:
- set title maximum length up to 200 characters
- set title minimum length
- avoid all-caps titles
- require one letter, avoiding titles with only digits or symbols

![settings](https://raw.githubusercontent.com/matteociaroni/flarum-title-restrictions/master/settings.png)

## Installation

Install with composer:

```sh
composer require matteociaroni/flarum-title-restrictions:dev-master
```

## Updating

```sh
composer update matteociaroni/flarum-title-restrictions:dev-master
php flarum migrate
php flarum cache:clear
```

## Links

- [GitHub](https://github.com/matteociaroni/flarum-title-restrictions)
- [Packagist](https://packagist.org/packages/matteociaroni/flarum-title-restrictions)
