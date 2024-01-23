<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Str;

class ColorEnum extends BaseEnum
{
    public const DEFAULT_BACKGROUND = '#FFFFFF';

    public const DEFAULT_COLOR = '#2D2D2D';

    public const DEFAULT_ACCENT = '#F1F5F9';

    public const PRIMARY_LIGHT = '#E1DBF2';

    public const PRIMARY = '#2B0988';

    public const PRIMARY_DARK = '#1D006B';

    public const SECONDARY_LIGHT = '#FFF2F7';

    public const SECONDARY = '#EB4D89';

    public const SECONDARY_DARK = '#D11F63';

    public const TERTIARY_LIGHT = '#FEF6DA';

    public const TERTIARY = '#FAC50B';

    public const TERTIARY_DARK = '#F19F00';

    public const DANGER = '#FF1F1F';

    public const WARNING = '#FAC50B';

    public const SUCCESS = '#08A057';

    public static function rootKey(string $key): string
    {
        return Str::replace('_', '-', Str::lower($key));
    }

    public static function settingKey(string $key): string
    {
        $colorKey = static::rootKey($key);

        return "color.{$colorKey}";
    }

    public static function variableName(string $key): string
    {
        return Str::camel(Str::lower($key));
    }
}
