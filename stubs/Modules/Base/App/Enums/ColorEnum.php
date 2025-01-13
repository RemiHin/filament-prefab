<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Str;

enum ColorEnum: string
{
    case DEFAULT_BACKGROUND = '#FFFFFF';

    case DEFAULT_COLOR = '#2D2D2D';

    case DEFAULT_ACCENT = '#F1F5F9';

    case PRIMARY_LIGHT = '#E1DBF2';

    case PRIMARY = '#2B0988';

    case PRIMARY_DARK = '#1D006B';

    case SECONDARY_LIGHT = '#FFF2F7';

    case SECONDARY = '#EB4D89';

    case SECONDARY_DARK = '#D11F63';

    case TERTIARY_LIGHT = '#FEF6DA';

    case TERTIARY = '#FAC50B';

    case TERTIARY_DARK = '#F19F00';

    case DANGER = '#FF1F1F';

    case WARNING = '#FACA0B';

    case SUCCESS = '#08A057';

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
