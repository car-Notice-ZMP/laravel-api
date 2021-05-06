<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Notice;

class CheckOwn
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
        $id     = $request->route('id');
        $notice = Notice::findOrFail($id);

        if(auth()->user()->id != $notice->user_id)
        {
            return $next($request);
        }
        else
        {
            return response()->json(['message'=>'Nie możesz obserwować własnego ogłoszenia'], 401);
        }
    }
}
