<?php

namespace App\Enums;

enum ApplicantStatus: string
{
    case NEW = 'new';

    case REJECTED = 'rejected';

    case PLANNED = 'planned';

    case HIRED = 'hired';

    public function translate(): string
    {
        return match ($this) {
            self::NEW => __('New'),
            self::REJECTED => __('Rejected'),
            self::PLANNED => __('Planned'),
            self::HIRED => __('Hired'),
        };
    }
}
