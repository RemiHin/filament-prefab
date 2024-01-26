<?php

declare(strict_types=1);

namespace App\Rules;

use App\Exceptions\VideoProviderNotSupportedException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class VideoUrl implements Rule
{
    public const YOUTUBE_REGEX = '/(youtube.com|youtu.be|youtube-nocookie.com)\/(watch)?(\?v=)?(embed)?(?<id>\S+)?/';

    public const VIMEO_REGEX = '/(vimeo.com)\/(video\/)?(?<id>\S+)?/';

    public array $supportedProviders = [
        'youtube',
        'vimeo',
    ];


    public function passes($attribute, $value, $providers = null): bool
    {
        // If null, return true as it is not required according to rules.
        if (is_null($value)) {
            return true;
        }

        // If no providers were specified, allow all supported providers.
        if (! $providers) {
            $providers = $this->supportedProviders;
        }

        // Validate that the requested providers are supported.
        $this->validateProviders($providers);

        // Check if url matches one of the providers.
        foreach ($providers as $provider) {
            if (! is_null($this->getVideoIdForProvider($value, $provider))) {
                return true;
            }
        }

        return false;
    }

    public function getVideoIdForProvider(?string $value, string $provider): ?string
    {
        return match ($provider) {
            'youtube' => $this->getVideoId($value, static::YOUTUBE_REGEX),
            'vimeo' => $this->getVideoId($value, static::VIMEO_REGEX),
            default => throw new VideoProviderNotSupportedException($provider),
        };
    }

    public function getVideoIdFromUrl(string $url, ?array $providers = null): ?string
    {
        if (is_null($providers)) {
            $providers = $this->supportedProviders;
        }

        foreach ($providers as $provider) {
            if ($id = $this->getVideoIdForProvider($url, $provider)) {
                return $id;
            }
        }

        return null;
    }

    protected function getVideoId(?string $value, string $regex): ?string
    {
        preg_match($regex, $value, $matches, PREG_UNMATCHED_AS_NULL);

        return Arr::get($matches, 'id');
    }

    public function validateProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            if (! in_array($provider, $this->supportedProviders)) {
                throw new VideoProviderNotSupportedException($provider);
            }
        }
    }

    public function getProviderFromUrl(string $url): ?string
    {
        foreach ($this->supportedProviders as $provider) {
            if (! is_null($this->getVideoIdForProvider($url, $provider))) {
                return $provider;
            }
        }

        return null;
    }
    
    public function message()
    {
        // TODO: Implement message() method.
    }
}
