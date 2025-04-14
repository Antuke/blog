<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommenterAuth
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('commenter_id')) {
            // Redirect to login page or show error
            return redirect()->route('login.google');
        }
        
        return $next($request);
    }
}