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
6. Install all modules:
- `php artisan prefab:filament --module=base --force` (be patient with the shell script, force is required to overwrite the user model)
- `php artisan prefab:filament --module=blog`
- `php artisan prefab:filament --module=hero-image`
- `php artisan prefab:filament --module=news`
- `php artisan prefab:filament --module=story`
- `php artisan prefab:filament --module=employee`
7. `php artisan migrate`
8. Create a user `php artisan make:filament-user` and follow the prompts
9. `php artisan db:seed`
10. `npm install && npm run dev`

### How to use Hero Images
1. add the `use Heroable` trait to the model
2. add `static::$model::heroableFields(),` to the form fields in the resource

### How to use Employees
1. add the `use Employeeable` trait to the model
2. add `static::$model::employeeableFields(),` to the form fields in the resource

### How to use Seoable en Ogable
1. add the `use Seoable` and `use Ogable` trait to the model
2. add `SeoFields::make(),` and `OGFields::make(),` to the form fields in the resource

### How to use Labels
1. add the `use Labelable` trait to the model
2. add `static::$model::labelableFields(),` to the form fields in the resource

### Front-end
1. visit `/blog` for a blog overview
2. visit `/blog/{blog:slug}` for the show page of a blog

### Biggest Todos:
- [ ] Cookie consent `Base module`
- [ ] Something formbuilder-like (alternative methods?) (https://filamentphp.com/plugins/lara-zeus-bolt)? `Contact module`
- [x] Blocks module (WIP) `Blocks module`
- [ ] Email sending (?) `Job Alert`
- [ ] Search functionalities `Search Module`
- [ ] Donation module
- [ ] Redirects en dead-link tracker

### "Copypaste" Todos:
- [x] Employee
- [ ] Location
- [x] News
- [x] Service
- [x] Story
- [ ] Vacancy
- [ ] Settings


## dependencies:
- `filamentphp/filament`
- `awcodes/filament-curator` (media manager)
- `solution-forest/filament-tree` (menu builder)
