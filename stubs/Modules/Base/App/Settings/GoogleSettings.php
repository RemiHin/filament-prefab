<?php

namespace RemiHin\FilamentPrefabStubs\Modules\Base\App\Settings;

use Spatie\LaravelSettings\Settings;

class GoogleSettings extends Settings
{
    public ?string $gtm_id;

    public static function group(): string
    {
        return 'settings';
    }
}
