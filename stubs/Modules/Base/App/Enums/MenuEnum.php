<?php

declare(strict_types=1);

namespace App\Enums;

enum MenuEnum: string
{
    case MAIN = 'main-menu';

    case TOP = 'top-menu';

    case FOOTER = 'footer-menu';

    case LEGAL_TERMS = 'legal-terms';
}
