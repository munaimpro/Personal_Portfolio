<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens([
            'Admin/userSignup',
            'Admin/userSignin',
            'Admin/userSignout',
            'Admin/userSendOTP',
            'Admin/userOTPVerification',
            'Admin/userResetPassword',
            'Admin/userProfile',
            'Admin/userUpdateProfile',
            'Admin/addAboutInfo',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
