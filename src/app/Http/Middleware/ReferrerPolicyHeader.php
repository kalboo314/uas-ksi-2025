<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReferrerPolicyHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Referrer-Policy', 'no-referrer');

        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self'; " .
            "style-src 'self'; " . 
            "img-src 'self' data:; " .
            "font-src 'self'; " .
            "object-src 'none'; " .
            "base-uri 'self'; " .
            "frame-ancestors 'none';"
        );

        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=15768000; includeSubDomains');
        }

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        return $response;
    }
}
