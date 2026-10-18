<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDealerApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isDealer()) {
            abort(403);
        }

        $dealerProfile = $user->dealerProfile()->first();

        if (! $dealerProfile?->isApproved()) {
            return redirect()->route('dealer.pending')->with('status', 'Bayi başvurunuz onay bekliyor.');
        }

        return $next($request);
    }
}
