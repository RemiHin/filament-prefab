<div class="cookie-consent cc-page">
    <form method="post" action="{{ route('cookie_consent') }}" id="cc-settings-form" onsubmit="submit.disabled = true; submitAll.disabled = true;">
        @csrf

        <div class="cc-settings" id="js-cookie-settings-container">
            <fieldset>
                <legend>Cookievoorkeuren</legend>
                <ul>
                    @foreach(config('cookie-consent.cookie_types', []) as $name => $options)
                        <li>
                            @include('cookie-consent.partials.cookie-type', ['name' => $name, 'options' => $options])
                        </li>
                    @endforeach
                </ul>
            </fieldset>

            <div class="cc-settings-buttons">
                <button name="submitAll" class="cc-button submit" type="submit" onclick="selectAll()">
                    @lang("cookie-consent.button.accept-all", ['website' => config('cookie-consent.website_name')])
                </button>
                <button name="submit" class="cc-button" type="submit">
                    @lang("cookie-consent.button.save", ['website' => config('cookie-consent.website_name')])
                </button>
            </div>
        </div>
    </form>
</div>

@include('cookie-consent.partials.scripts')
