composer require filament/filament:"^3.2" -W
composer require laravel/sanctum
npm install -D tailwindcss postcss autoprefixer
npm install -D @tailwindcss/forms
npm install -D @tailwindcss/typography
npm install swiper@9.3.2
composer require dejury/gptfaker --dev
composer require awcodes/filament-curator
composer require solution-forest/filament-tree
composer require motivo/filament-title-with-slug
composer require laravel/scout
composer require babenkoivan/elastic-scout-driver
composer require filament/spatie-laravel-settings-plugin:"^3.2" -W
composer require propaganistas/laravel-phone
composer require axlon/laravel-postal-code-validation
composer require kirschbaum-development/eloquent-power-joins
composer require guava/filament-icon-picker
php artisan filament:assets
php artisan vendor:publish --tag="filament-tree-config"
php artisan curator:install --no-interaction
npm install -D cropperjs
