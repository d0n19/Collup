<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPremiumLimit
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user->is_premium && $user->projects()->count() >= 3) {
            return back()->with('error', 'Free tier users are limited to 3 active projects. Upgrade to CollabUp Premium for unlimited projects!');
        }

        return $next($request);
    }
}
