<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureLandingPageActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $landingPage = $request->route('landingPage') ?? $request->route('landing_page');

        if (is_object($landingPage) && method_exists($landingPage, 'getAttribute')) {
            abort_unless((bool) $landingPage->getAttribute('is_active'), 404);
        }

        return $next($request);
    }
}
