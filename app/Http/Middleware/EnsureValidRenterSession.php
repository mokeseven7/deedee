<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Concerns\UseMultiRenterConfig;
use Symfony\Component\HttpFoundation\Response;

class EnsureValidRenterSession
{
    use UseMultiRenterConfig;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $sessionKey = 'ensure_valid_renter_session_tenant_id';

        if (! $request->session()->has($sessionKey)) {
            $request->session()->put($sessionKey, app($this->currentRenterContainerKey())->id);

            return $next($request);
        }
        

        if ($request->session()->get($sessionKey) !== app($this->currentRenterContainerKey())->id) {
            return $this->handleInvalidRenterResponse($request);
        }

        return $next($request);

    }

    protected function handleInvalidRenterResponse($request)
    {
        abort(Response::HTTP_UNAUTHORIZED);
    }
}
