# Title restriction for Flarum

![License](https://img.shields.io/badge/license-MIT-blue.svg)

A [Flarum](http://flarum.org) extension to add some restrictions to titles:
- set title maximum length up to 200 characters
- set title minimum length
- avoid all-caps titles
- require one letter, avoiding titles with only digits or symbols

## Installation

Install with composer:

```sh
composer require matteociaroni/flarum-title-restrictions:"*"
```

## Updating

```sh
composer update matteociaroni/flarum-title-restrictions:"*"
php flarum migrate
php flarum cache:clear
```

## Links

- [GitHub](https://github.com/matteociaroni/flarum-title-restrictions)
