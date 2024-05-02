<?php

declare(strict_types=1);

use App\Models\Label;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Cache;

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

if (! function_exists('get_model_for_label')) {
    function get_model_for_label(string $label, ?array $load = null, bool $ignoreCache = false): mixed
    {
        if ($ignoreCache) {
            $model = Label::getModel($label);

            if ($load) {
                $model->load($load);
            }

            return $model;
        }

        return Cache::remember("label.{$label}", 60 * 60 * 24, function () use ($label, $load) {
            /** @var \Illuminate\Database\Eloquent\Model $model */
            $model = Label::getModel($label);

            if ($load) {
                $model->load($load);
            }

            return $model;
        });
    }
}
