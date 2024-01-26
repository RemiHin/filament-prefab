<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class VideoProviderNotSupportedException extends Exception
{
    public function __construct($provider, $code = 0, Throwable $previous = null)
    {
        parent::__construct("Video provider '{$provider}' not supported.", $code, $previous);
    }
}
