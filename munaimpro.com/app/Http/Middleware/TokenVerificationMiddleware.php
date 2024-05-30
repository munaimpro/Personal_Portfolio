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
        $SigninToken    = $request->cookie('SigninToken');
        $VerifyOTPToken = $request->cookie('VerifyOTPToken');
        
        /**
        * VerifyToken method call and token pass for check availability
        */
        
        $SigninTokenResult = JWTToken::VerifyToken($SigninToken); // Check sign in token 
        $VerifyOTPTokenResult = JWTToken::VerifyToken($VerifyOTPToken); // Check otp verification token

        if($SigninTokenResult == "Unauthorized"){
            if(($VerifyOTPTokenResult == "Unauthorized") && $request->is('Admin/password_reset')){
                return redirect()->back();
            } else{
                return $next($request);
            }

            if($request->is('Admin/signup') || $request->is('Admin/signin') || $request->is('Admin/sendotp') || $request->is('Admin/verifyotp') || $request->is('Admin/password_reset')){
                return $next($request);
            } else{
                return redirect('Admin/signin');
            }
        } else{
            if($request->is('Admin/signup') || $request->is('Admin/signin') || $request->is('Admin/sendotp') || $request->is('Admin/verifyotp') || $request->is('Admin/password_reset')){
                return redirect()->back();
            } else{
                $request->headers->set('userEmail', $SigninTokenResult->userEmail);
                $request->headers->set('userId', $SigninTokenResult->userId);
                return $next($request);
            }
            
        }
        
        if(($VerifyOTPTokenResult == "Unauthorized") && $request->is('Admin/password_reset')){
            return redirect('/sendotp');
        } else{
            return $next($request);
        }
    }
}
