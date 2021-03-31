<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class KesGub
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
        if(\Auth::user()->level == 'gubernur' || \Auth::user()->level == 'dinkes')
        {
            return $next($request);
        }
        return abort(404);
    }
}