<?php

namespace App\Http\Middleware;

use Closure;

class Secure {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (!$request->secure()) {
            // return redirect()->secure($request->getRequestUri());
        }
        $response = $next($request);
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN', true);
        return $response;
    }

}
