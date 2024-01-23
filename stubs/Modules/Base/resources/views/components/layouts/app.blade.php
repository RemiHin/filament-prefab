@props([
    'title' => null,
//  todo:  'showCookieConsent' => true,
])

<!doctype html>
<html lang="{{ str_replace('_', '-', App::getLocale()) }}" data-theme="default" class="fontsize-default">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('canonical')

    @section('seo')
        <x-seo />
    @show

    @section('og')
        <x-og />
    @show

    @stack('structured-data')

{{--  todo:  @cookieConsentCss()--}}

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{-- TODO:    <x-layouts.partials.css-variables></x-layouts.partials.css-variables>--}}
    @stack('css')

    <x-measurement-tools />
</head>

<body class="min-h-screen flex flex-col">
{{-- todo:   @if($showCookieConsent)--}}
{{--        @cookieConsent()--}}
{{--    @endif--}}

    @stack('body-top')

    <x-layouts.partials.header />
    <x-wcag.wcag-modal />

    <div id="main-content" class="flex-grow w-full">
        @section('breadcrumbs')
        @show
        <main id="app">
            {{ $slot }}
        </main>
    </div>

    <x-layouts.partials.footer />

    @livewireScripts
    @stack('scripts')
</body>
</html>
