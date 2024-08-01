<?php

namespace App\Enums;

enum RedirectType: int
{
    case FORWARD = 0;

    case PERMANENT = 1;

    case TEMPORARY = 2;

    public function translate(): string
    {
        return match ($this) {
            self::PERMANENT => __('Permanent (301)'),
            self::TEMPORARY => __('Temporary (302)'),
            default => __('No redirect'),
        };
    }
}
