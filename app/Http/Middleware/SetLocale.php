<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek locale dari session
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
            Log::info('Locale from session: ' . Session::get('locale'));
        } 
        // Cek locale dari query parameter
        elseif ($request->has('locale')) {
            $locale = $request->get('locale');
            if (in_array($locale, config('app.supported_locales', ['id', 'en']))) {
                App::setLocale($locale);
                Session::put('locale', $locale);
                Log::info('Locale from query: ' . $locale);
            }
        }

        Log::info('Current locale: ' . App::getLocale());
        
        return $next($request);
    }
}
