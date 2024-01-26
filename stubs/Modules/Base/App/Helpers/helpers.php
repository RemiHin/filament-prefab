<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

if (! function_exists('inlineSVG')) {
    function inlineSVG(string $path): HtmlString
    {
        $html = '';

        $path = ltrim($path, '/');
        $path = str_replace('\'', '', $path);
        $path = Str::finish($path, '.svg');

        $filePath = public_path($path);

        if (! is_file($filePath)) {
            return new HtmlString($html);
        }

        return new HtmlString(file_get_contents($filePath));
    }
}

if (! function_exists('get_video_id')) {
    function get_video_id(string $url): string
    {
        return (new \App\Rules\VideoUrl())->getVideoIdFromUrl($url);
    }
}
