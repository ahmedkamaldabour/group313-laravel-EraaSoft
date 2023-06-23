<?php

namespace App\Http\Middleware;

use App\Http\traits\ApiTrait;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    use ApiTrait;
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
//            if($guard == 'sanctum'){
//                return $this->apiResponse('401' , 'You Are Already Logged In' , 'null' , 'null');
//            }
            if (Auth::guard($guard)->check()) {
                return redirect()->route('admin');
            }
        }
        return $next($request);
    }
}
