<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->level === 1) { // Assuming 'level' 1 is admin
            return $next($request);
        }

        return redirect()->route('dashboard'); // Or another route for unauthorized access
    }
}