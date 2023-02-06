<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Concerns\UsesRenterModel;

class RenterRequired
{

    use UsesRenterModel;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        

        if (! $this->getRenterModel()::checkCurrent()) {
            return throw new Exception('Unable To Find Renter With That Domain. Please Contact DeeDee For Further Support');
        }

        return $next($request);
    }
}
