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
- `php artisan prefab:filament --module=base --force`
  - be patient with the shell script, force is required to overwrite the user model
- `php artisan prefab:filament --module=blog`
- `php artisan prefab:filament --module=hero-image`
- `php artisan prefab:filament --module=news`
- `php artisan prefab:filament --module=story`
- `php artisan prefab:filament --module=employee`
- NOTE: When updating modules after their initial rollout add `--force` to override local files. Additionally `--no-shell` can be added to prevent shell commands from being executed to speed up rolling out updates.
7. `composer dump`
8. `php artisan migrate`
9. Create a user `php artisan make:filament-user` and follow the prompts
10. `php artisan db:seed`
11. open `docker-compose.yml` and replace the container_name with a name of this project
12. `docker compose up -d`
13. `npm install && npm run dev`

### How to use search
1. Add the `IsSearchable` interface to the model
2. Implement the required methods. Your IDE will inform you when adding the interface.
3. Add the `use Searchable` trait to the model
4. Add the config to `searchable.php` config by adding it to the `models` array where the key is the model and the value is an array with the searchable columns
5. Modules can also be specified in the `modules` section in `searchable.php`. Here the key is the relation name and the value an array of searchable fields. To search a module on a model add the name of the resource to the model array like you would add a column
6. In the example below the page searches in the columns `name` and `content`, as well as the module `heroImage`, for which the columns `title` and `content` are searchable
```php
'models' => [
    Page::class => [
        'name',
        'content',
        'heroImage',
    ],
],

'modules' => [
    'heroImage' => [
        'title',
        'content',
    ],
],
```

To sync models to elastic run `php artisan search:sync`


### How to use Hero Images
1. add the `use Heroable` trait to the model
2. add `static::$model::heroableFields(),` to the form fields in the resource

### How to use Employees
1. add the `use Employeeable` trait to the model
2. add `static::$model::employeeableFields(),` to the form fields in the resource

### How to use Seoable en Ogable
1. add the `use Seoable`trait to the model
2. add `static::$model::seoFields(),` to the form fields in the resource

### How to use Labels
1. add the `use Labelable` trait to the model
2. add `static::$model::labelableFields(),` to the form fields in the resource

### Front-end
1. visit `/blog` for a blog overview
2. visit `/blog/{blog:slug}` for the show page of a blog

### Biggest Todos:
- [x] Update naar Laravel 11
- [ ] slugs
- [x] redo SEO as field instead of trait (?)
- [ ] Cookie consent `Base module`
- [ ] Something formbuilder-like (alternative methods?) (https://filamentphp.com/plugins/lara-zeus-bolt)? `Contact module`
- [x] Blocks module (WIP) `Blocks module`
- [ ] Email sending (?) `Job Alert`
- [x] Search functionalities `Search Module`
- [ ] Donation module
- [ ] Redirects en dead-link tracker
- [ ] Add route for home

### "Copypaste" Todos:
- [x] Employee
- [ ] Location
- [x] News
- [x] Service
- [x] Story
- [ ] Vacancy
- [ ] Settings
- [ ] Toptasks


## dependencies:
- `filamentphp/filament`
- `awcodes/filament-curator` (media manager)
- `solution-forest/filament-tree` (menu builder)
