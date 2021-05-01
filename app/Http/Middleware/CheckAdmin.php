<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
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
        if(auth()->user()->admin === 1)
        {
            return $next($request);
        }
        else
        {
            return response()->json(['message'=>'Nie jesteś adminem'], 401);
        }
    }
}
