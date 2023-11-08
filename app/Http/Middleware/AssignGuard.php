<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;

class AssignGuard
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard != null) {
            auth()->shouldUse($guard); //shoud you user guard / table
        }
        return $next($request);
    }
}
