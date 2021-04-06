<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Gubernur
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
        if(\Auth::user()->level != 'walikota')
        {
            return abort(404);
        }
        return $next($request);
    }
}