<?php
use Illuminate\Support\Facades\Cookie;

if (! function_exists('cookieConsentAccepted')) {
    function cookieConsentAccepted(): bool
    {
        return Cookie::get(config('cookie-consent.cookie_name')) == 1;
    }
}

if (! function_exists('cookieConsentDenied')) {
    function cookieConsentDenied(): bool
    {
        return Cookie::get(config('cookie-consent.cookie_name')) === '0';
    }
}
