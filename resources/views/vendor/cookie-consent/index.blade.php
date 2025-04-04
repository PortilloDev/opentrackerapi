@if($cookieConsentConfig['enabled'] && ! $alreadyConsentedWithCookies)

    @include('cookie-consent::dialogContents')

    <script>

        window.laravelCookieConsent = (function () {

            const COOKIE_VALUE_ACCEPTED = 1;
            const COOKIE_VALUE_DENIED = 0;
            const COOKIE_DOMAIN = '{{ config('session.domain') ?? request()->getHost() }}';

            function consentWithCookies() {
                setCookie('{{ $cookieConsentConfig['cookie_name'] }}', COOKIE_VALUE_ACCEPTED, {{ $cookieConsentConfig['cookie_lifetime'] }});
                hideCookieDialog();
                location.reload();
            }

            function denyCookies() {
                setCookie('{{ $cookieConsentConfig['cookie_name'] }}', COOKIE_VALUE_DENIED, {{ $cookieConsentConfig['cookie_lifetime'] }});
                hideCookieDialog();
                location.reload();
            }

            function cookieExists(name, value) {
                const cookies = document.cookie.split('; ');
                return cookies.indexOf(name + '=' + value) !== -1;
            }

            function hideCookieDialog() {
                const dialogs = document.getElementsByClassName('js-cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }

            function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                let cookieString = name + '=' + value
                    + ';expires=' + date.toUTCString()
                    + ';path=/';

                if (COOKIE_DOMAIN) {
                    cookieString += ';domain=' + COOKIE_DOMAIN;
                }

                @if(config('session.secure'))
                    cookieString += ';secure';
                @endif

                    @if(config('session.same_site'))
                    cookieString += ';samesite={{ config('session.same_site') }}';
                @endif

                    document.cookie = cookieString;
            }

            const consentCookieName = '{{ $cookieConsentConfig['cookie_name'] }}';

            if (cookieExists(consentCookieName, COOKIE_VALUE_ACCEPTED) || cookieExists(consentCookieName, COOKIE_VALUE_DENIED)) {
                hideCookieDialog();
            }

            const agreeButtons = document.getElementsByClassName('js-cookie-consent-agree');
            const denyButtons = document.getElementsByClassName('js-cookie-consent-disagree');

            for (let i = 0; i < agreeButtons.length; ++i) {
                agreeButtons[i].addEventListener('click', consentWithCookies);
            }

            for (let i = 0; i < denyButtons.length; ++i) {
                denyButtons[i].addEventListener('click', denyCookies);
            }

            return {
                consentWithCookies: consentWithCookies,
                denyCookies: denyCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();
    </script>

@endif
