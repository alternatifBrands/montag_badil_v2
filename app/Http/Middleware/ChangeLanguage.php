<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App; 
use Symfony\Component\HttpFoundation\Response;

class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        $language = $request->query('lang');
 
        if ($language && in_array($language,['ar','en','tr'])) { 
            App::setLocale($language);
        }

        return $next($request);
    }
}
