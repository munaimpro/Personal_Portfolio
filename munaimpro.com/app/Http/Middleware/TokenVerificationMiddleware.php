<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\JWTController\JWTToken;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('SigninToken');
        
        /**
        * VerifyToken method call and token pass for check availability
        */
        
        $result = JWTToken::VerifyToken($token);

        if($result == "Unauthorized"){
            if($request->is('Admin/signup') || $request->is('Admin/signin') || $request->is('Admin/sendotp') || $request->is('Admin/verifyotp')){
                return $next($request);
            } else{
                return redirect('/signin');
            }
        } else{
            if($request->is('Admin/signup') || $request->is('Admin/signin') || $request->is('Admin/sendotp') || $request->is('Admin/verifyotp')){
                return redirect('/');
            } else{
                $request->headers->set('userEmail', $result->userEmail);
                $request->headers->set('userId', $result->userId);
                return $next($request);
            }
            
        }
        
    }
}
