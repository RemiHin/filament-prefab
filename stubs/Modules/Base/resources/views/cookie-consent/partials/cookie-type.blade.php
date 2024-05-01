@php($checked = CookieConsent::hasConsentFor($name, $options['default_checked'] ?? false))

<div class="cc-setting-option js-cookie-setting-button @unless($options['required'] ?? false) js-cookie-toggleable @endif @if($checked) cc-setting-selected @endif">
    <h3 class="cc-setting-title">
        @lang("cookie-consent.$name.name")

        <label class="switch @if($options['required'] ?? false) disabled @endif">
            <input
                type="checkbox"
                name="cookie_consent_types[]"
                value="{{ $name }}"
                aria-label="@lang("cookie-consent.$name.name")"
                class="js-cookie-setting-button-input"
                @if($checked) checked="checked" @endif
                @if($options['required'] ?? false) tabindex="-1" disabled="disabled" @endif
            >
            <span class="slider round"></span>
        </label>
    </h3>

    <p class="cc-setting-text">
        @lang("cookie-consent.$name.description", ['website' => config('cookie-consent.website_name')])

        @if($options['required'] ?? false)
            <strong>@lang("cookie-consent.required", ['name' => trans("cookie-consent.$name.name")])</strong>
        @endif
    </p>
</div>
