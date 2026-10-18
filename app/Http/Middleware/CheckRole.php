<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        $allowed = collect($roles)
            ->map(fn (string $role): string => trim($role))
            ->filter()
            ->contains(fn (string $role): bool => $user->role === UserRole::tryFrom($role));

        abort_unless($allowed, 403);

        return $next($request);
    }
}
