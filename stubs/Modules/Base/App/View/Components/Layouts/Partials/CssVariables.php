<?php

declare(strict_types=1);


namespace App\View\Components\Layouts\Partials;

use App\Enums\ContrastColorEnum;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class CssVariables extends Component
{
//    /**
//     * Get the view / contents that represent the component.
//     *
//     * @return \Illuminate\Contracts\View\View|\Closure|string
//     */
//    public function render()
//    {
//        return view('components.layouts.partials.css-variables', [
//            'colors' => $this->getColors(),
//            'contrastColors' => $this->getContrastColors(),
//        ]);
//    }
//
//    protected function getColors(): array
//    {
//        if (Cache::has('frontend.colors')) {
//            return Cache::get('frontend.colors');
//        }
//
//        $colors = [];
//
//        foreach (ColorEnum::getKeys() as $key) {
//            $colors[ColorEnum::rootKey($key)] = Setting::getSettingRaw(ColorEnum::settingKey($key), constant(ColorEnum::class . '::' . $key));
//        }
//
//        Cache::put('frontend.colors', $colors, now()->addDay());
//
//        return $colors;
//    }
//
//    protected function getContrastColors(): array
//    {
//        if (Cache::has('frontend.contrast-colors')) {
//            return Cache::get('frontend.contrast-colors');
//        }
//
//        $colors = [];
//
//        foreach (ContrastColorEnum::getKeys() as $key) {
//            $colors[ContrastColorEnum::rootKey($key)] = Setting::getSettingRaw(ContrastColorEnum::settingKey($key), constant(ContrastColorEnum::class . '::' . $key));
//        }
//
//        Cache::put('frontend.contrast-colors', $colors, now()->addDay());
//
//        return $colors;
//    }
}
