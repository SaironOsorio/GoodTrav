<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checksubcription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }
        if($user->is_admin){
            return $next($request);
        }
        $hasActiveSubscription = $user->subscription_start_date
            && $user->subscription_end_date
            && $user->subscription_start_date <= now()
            && $user->subscription_end_date >= now();

        if (!$hasActiveSubscription) {
            return redirect()->route('subscription');
        }

        // Si tiene suscripción activa, continuar
        return $next($request);
    }
}
