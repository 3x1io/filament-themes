# Filament Theme Manager

FrontEnd Themes Manager For Filament Admin

## Installation

You can install the package via composer:

```bash
composer require 3x1io/filament-themes
```

Run migration:

```bash
php artisan vendor:publish --provider="Spatie\LaravelSettings\LaravelSettingsServiceProvider" --tag="migrations"
php artisan migrate
```

Then publish the assets:

```bash
php artisan vendor:publish --tag="filament-themes"
```

Run migration:

```bash
php artisan migrate
```

Remove default route from routes/web.php

```bash
php artisan optimize
```

add to your composer.json

```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/",
        "Themes\\": "resources/views/themes/"
    }
},
```

```bash
composer dump-autoload
```

## Create New Theme

to create a new theme first of all you need to create a new folder inside `resources/views/themes` with you theme name and this name <b>must be without spaces</b>, inside this folder create a new json file named `info.json` and on this file put this json object

```json
{
  "name": "3x1 Theme",
  "ar": "ثري اكس ون ثيم",
  "description": "3x1 Theme Is Default Theme Of 3x1 Framework",
  "description_ar": "الثيم الافتراضي لنطاق عمل 3x1",
  "keywords": [],
  "aliases": "3x1",
  "files": [],
  "requires": [],
  "image": "placeholder.webp"
}
```

> {info} the `aliases` must be the same as theme folder name

now we need to add some folders & files inside the theme main folder:

1. `controller` <small>this folder use to add a controllers to theme</small>
2. `routes/web.php` <small>this file use to add a routes for this theme</small>
3. `layouts/app.blade.php` <small>this file use as main layout of the theme</small>
4. `pages/home.blade.php` <small>this file use as homepage</small>

you can include a file in a head of your theme to support SEO this by use this code inside `<head></head>`

```php
@include('includes.meta')
```

the last thing we must to do it to add the assets folder of the theme to `public/themes/THEME_NAME` where `THEME_NAME` is the name of the theme.

<hr>

## Theme Helpers

our theme feature has some helpers to make it easy to make a frontend theme like theme assets url

```php
theme_assets()
```

this function take a `url` and make it easy to access your theme path `public/themes/THEME_NAME/`

```php
theme_namespace()
```

this function get the namespace for the controller folder of the current theme

```php
show_menu()
```

this function take a `key` and get this key from `settings` table and decode it to array so you can use it when you make a menu inside a json setting.

```php
dollar()
```

this function take a `number` and convert it to money style with a currency symbol

<hr>

## Generate a Theme Controller

our themes feature support artisan command to generate a new theme controller you can use this command like

```bash
php artisan themes:controller CONTROLLER_NAME THEME_NAME
```

where `CONTROLLER_NAME` is the name of the controller & `THEME_NAME` is the name of the theme

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [3x1](https://github.com/3x1io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
