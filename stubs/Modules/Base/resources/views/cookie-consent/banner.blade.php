@if (! \CookieConsent::hasConsent())
    <section class="cookie-consent cc-banner">
        <div class="cc-banner-container">
            <div class="cc-top">
                <div class="cc-top-group">
                    <div class="cc-top-content">
                        <h2 class="cc-top-title">
                            @lang("cookie-consent.title", ['website' => config('cookie-consent.website_name')])
                        </h2>
                        <p class="cc-top-text">
                            @lang("cookie-consent.description", ['website' => config('cookie-consent.website_name')])

                            @if (config('cookie-consent.cookie_page'))
                                <a class="cc-link" href="{{ url(CookieConsent::page()->slug) }}">
                                    @lang("cookie-consent.button.more-info", ['website' => config('cookie-consent.website_name')])
                                </a>
                            @endif
                        </p>
                    </div>
                    <form method="post" action="{{ route('cookie_consent') }}" onsubmit="submit.disabled = true">
                        @csrf

                        @foreach(config('cookie-consent.cookie_types', []) as $name => $options)
                            <input type="hidden" name="cookie_consent_types[]" value="{{ $name }}">
                        @endforeach

                        <div class="cc-top-buttons">
                            <button class="cc-button submit" type="submit">
                                @lang("cookie-consent.button.accept-all", ['website' => config('cookie-consent.website_name')])
                            </button>
                            <button class="cc-button" name="submit" type="button" id="js-cookie-settings-button" aria-expanded="false">
                                @lang("cookie-consent.button.preferences", ['website' => config('cookie-consent.website_name')])
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <form method="post" action="{{ route('cookie_consent') }}" id="cc-settings-form" onsubmit="submit.disabled = true">
                @csrf

                <fieldset class="cc-settings" id="js-cookie-settings-container" style="display: none;">
                    <legend>Cookievoorkeuren</legend>
                    <ul class="cc-options-container">
                        @foreach(config('cookie-consent.cookie_types', []) as $name => $options)
                            <li>
                                @include('cookie-consent.partials.cookie-type', ['name' => $name, 'options' => $options])
                            </li>
                        @endforeach
                    </ul>

                    <div class="cc-settings-buttons">
                        <button class="cc-button submit" name="submit" type="submit">
                            @lang("cookie-consent.button.save", ['website' => config('cookie-consent.website_name')])
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>

    @include('cookie-consent.partials.scripts')
@endif
