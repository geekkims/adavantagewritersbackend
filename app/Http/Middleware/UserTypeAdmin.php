<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTypeAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->usertype == 'admin') {
            return $next($request);
        }

        return response()->view('errors.permission', [], 403);
    }
}
