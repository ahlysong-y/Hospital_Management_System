<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request and set the active locale session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale', 'km'));

        if (in_array($locale, ['km', 'en', 'zh', 'ja', 'ko'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
