<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ['cs', 'en', 'es'];
        $locale = $request->segment(1);

        // If locale is in URL and is supported, use it
        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        } else {
            // Try to get locale from session
            $sessionLocale = Session::get('locale');
            if ($sessionLocale && in_array($sessionLocale, $supportedLocales)) {
                App::setLocale($sessionLocale);
            } else {
                // Default to Czech
                App::setLocale('cs');
            }
        }

        return $next($request);
    }
}
