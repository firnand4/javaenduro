<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/** Blokir kontributor (dan siapa pun yang bukan superadmin) dari panel /admin. */
class EnsureSuperadmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isSuperadmin()) {
            abort(403, 'Halaman ini khusus superadmin JavaEnduro.');
        }

        return $next($request);
    }
}
