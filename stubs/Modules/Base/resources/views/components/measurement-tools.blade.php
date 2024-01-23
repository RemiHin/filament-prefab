@if(! empty(config('google.verification_code')))
    <meta name="google-site-verification" content="{{ config('google.verification_code') }}" />
@endif

{{--TODO:@if(CookieConsent::isAnalysis() && ! empty(config('google.tag_manager')))--}}
{{--    <!-- Google Tag Manager -->--}}
{{--    <script>--}}
{{--        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':--}}
{{--            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],--}}
{{--            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=--}}
{{--            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);--}}
{{--        })(window,document,'script','dataLayer','{{ config('google.tag_manager') }}');--}}
{{--    </script>--}}
{{--    <!-- End Google Tag Manager -->--}}
{{--@endif--}}

{{--TODO:@if(CookieConsent::isAnalysis() && ! empty(config('google.tag_manager')))--}}
{{--    @push('body-top')--}}
{{--        <!-- Google Tag Manager (noscript) -->--}}
{{--        <noscript>--}}
{{--            <iframe src="https://www.googletagmanager.com/ns.html?id={{ config('google.tag_manager') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe>--}}
{{--        </noscript>--}}
{{--        <!-- End Google Tag Manager (noscript) -->--}}
{{--    @endpush--}}
{{--@endif--}}

{{--TODO:@if(CookieConsent::isAnalysis() && ! empty(config('google.analytics')))--}}
{{--    <!-- Global site tag (gtag.js) - Google Analytics -->--}}
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('google.analytics') }}"></script>--}}
{{--    <script>--}}
{{--        window.dataLayer = window.dataLayer || [];--}}

{{--        function gtag() {--}}
{{--                dataLayer.push(arguments);--}}
{{--        }--}}

{{--        gtag('js', new Date());--}}
{{--        gtag('config', '{{ config('google.analytics') }}');--}}
{{--    </script>--}}
{{--@endif--}}
