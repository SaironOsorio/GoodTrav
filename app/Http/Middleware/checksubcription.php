<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checksubcription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if($user && $user->subscription_start_date < now() && $user->subscription_end_date > now()){
            return redirect()->route('dashboard');
        }
        else{

            return redirect()->route('subscription');
        }
        return $next($request);
    }
}
