# Prefab

Use this template to scaffold a new website

## Installation

1. Create a new project `laravel new project-name`
2. clone this repository
3. update the `composer.json` of your new project and add: 
```
"repositories": {
    "filament-prefab": {
        "type": "path",
        "url": "../<path-to>/filament-prefab",
        "symlink": true
    }
} 
```
4. Change minimum stability to dev: `"minimum-stability": "dev",`
5. `composer require remihin/filament-prefab`
6. Install Base, Blog and Hero-Image modules:
7. `php artisan prefab:filament --module=base` (be patient with the shell script)
8. `php artisan prefab:filament --module=blog`
9. `php artisan prefab:filament --module=hero-image`
10. `php artisan migrate`
11. `npm install && npm run dev`
12. Create a user `php artisan make:filament-user` and follow the prompts
13. `php artisan db:seed`

### How to use Hero Images
1. add the `use Heroable` trait to the model
2. add `static::$model::heroableFields(),` to the form fields in the resource

### Front-end
1. visit `/blog` for a blog overview
2. visit `/blog/{blog:slug}` for the show page of a blog
