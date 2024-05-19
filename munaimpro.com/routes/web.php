<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;




/**
 * Route for Admin Panel
*/
Route::group(['prefix' => 'Admin'], function(){

// API Routes (User Controller)
    Route::post('userSignup', [UserController::class, 'userSignup']);
    Route::post('userSignin', [UserController::class, 'userSignin']);
    Route::get('userSignout', [UserController::class, 'userSignout']);
    Route::post('userSendOTP', [UserController::class, 'sendOTPCode']);
    Route::post('userOTPVerification', [UserController::class, 'verifyOTPCode']);
    Route::post('userResetPassword', [UserController::class, 'resetPassword']);
    Route::get('userProfile', [UserController::class, 'userProfile'])->middleware(TokenVerificationMiddleware::class);
    Route::post('userUpdateProfile', [UserController::class, 'updateProfile'])->middleware(TokenVerificationMiddleware::class);


// API Routes (User Controller)
    


// Page Routes (User Controller)
    Route::get('signin', [UserController::class, 'userSigninPage']);
});



// Route for Website