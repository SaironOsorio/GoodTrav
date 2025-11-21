<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockMobileAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent');
        
        // Detectar dispositivos móviles
        $isMobile = preg_match('/(android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini)/i', $userAgent);
        
        // Si es móvil y está intentando acceder a login o register, redirigir al home con mensaje
        if ($isMobile && ($request->is('login') || $request->is('register'))) {
            return redirect()->route('home')->with('mobile_warning', true);
        }
        
        return $next($request);
    }
}
