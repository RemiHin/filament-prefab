<?php

declare(strict_types=1);

namespace App\Filament\Plugins\Blocks;

use Filament\Forms;
use App\Actions\VideoUrl;
use App\Filament\Plugins\BaseBlock;

class VideoBlock extends BaseBlock
{
    public static function getType(): string
    {
        return 'video';
    }

    public static function getLabel(): string
    {
        return __('Video');
    }

    public static function getFields(): array
    {
        return [
            Forms\Components\TextInput::make('video_url')
                ->label(__('Video URL'))
                ->required()
                ->string()
                ->url()
                ->helperText(__('Enter the link to the Youtube or Vimeo video')),

            Forms\Components\Toggle::make('autoplay')
                ->label(__('Autoplay'))
                ->default(false)
                ->helperText(__('Vimeo\'s autoplay function doesn\'t always work')),

            Forms\Components\Toggle::make('loop')
                ->label(__('Repeat'))
                ->default(false),

            Forms\Components\Toggle::make('mute')
                ->label(__('Mute'))
                ->default(false)
                ->helperText(__('The video is always mutes when autoplay is on')),
        ];
    }

    public function params(): array
    {
        $params = [
            'autoplay' => $this->autoplay(),
            'mute' => $this->mute(),
            'loop' => $this->loop(),
            'enablejsapi' => 1,
            'origin' => url()->current(),
        ];

        if (config('block.video_disable_keyboard', false)) {
            $provider = VideoUrl::getProviderFromUrl($this->video_url);

            if ($provider === 'youtube') {
                $params['disablekb'] = 1;
            }

            if ($provider === 'vimeo') {
                $params['keyboard'] = 0;
            }
        }

        return $params;
    }

    public function paramString(): string
    {
        $output = [];

        foreach ($this->params() as $key => $value) {
            if (is_bool($value)) {
                $value = (int) $value;
            }

            $output[] = "{$key}={$value}";
        }

        return implode('&', $output);
    }

    public function videoId(): ?string
    {
        return video_id_from_url($this->video_url);
    }

    public function autoplay(): bool
    {
        return (bool) $this->autoplay;
    }

    public function mute(): bool
    {
        // Should always be muted when autoplay is enabled
        return $this->autoplay() || (bool) $this->mute;
    }

    public function loop(): bool
    {
        return (bool) $this->loop;
    }

    public static function getFactoryVideo(): string
    {
        $videos = [
            'https://www.youtube.com/watch?v=70VpNGdTGng',
            'https://www.youtube.com/watch?v=lDgp2j_KdV4',
            'https://www.youtube.com/watch?v=u3i0HBUIb2U',
            'https://www.youtube.com/watch?v=AKeUssuu3Is',
            'https://www.youtube.com/watch?v=XOrSmZI6yS0',
            'https://www.youtube.com/watch?v=hpfVMPCR3xA',
        ];

        return $videos[array_rand($videos)];
    }

    public static function factory(): ?array
    {
        return [
            'video_url' => static::getFactoryVideo(),
            'autoplay' => fake()->boolean(),
            'loop' => fake()->boolean(),
            'mute' => fake()->boolean(),
        ];
    }
}
