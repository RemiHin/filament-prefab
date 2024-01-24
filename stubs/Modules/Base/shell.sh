composer require filament/filament:"^3.2" -W
npm install -D tailwindcss postcss autoprefixer
npm install -D @tailwindcss/forms
npm install -D @tailwindcss/typography
npm install swiper@9.3.2
composer require dejury/gptfaker --dev
composer require awcodes/filament-curator
composer require solution-forest/filament-tree
php artisan filament:assets
php artisan vendor:publish --tag="filament-tree-config"
php artisan curator:install --no-interaction
npm install -D cropperjs
