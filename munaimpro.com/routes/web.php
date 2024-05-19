<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\EducationController;
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


// API Routes (About Controller)
    Route::post('addAboutInfo', [AboutController::class, 'addAboutInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::post('updateAboutInfo', [AboutController::class, 'updateAboutInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAboutInfo', [AboutController::class, 'retriveAboutInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Education Controller)
    Route::post('addEducationInfo', [EducationController::class, 'addEducationInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::post('updateEducationInfo', [EducationController::class, 'updateEducationInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveEducationInfo', [EducationController::class, 'retriveEducationInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::post('deleteEducationInfo', [EducationController::class, 'deleteEducationInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Skill Controller)
    Route::post('addSkillInfo', [SkillController::class, 'addSkillInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::post('updateSkillInfo', [SkillController::class, 'updateSkillInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveSkillInfo', [SkillController::class, 'retriveSkillInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::post('deleteSkillInfo', [SkillController::class, 'deleteSkillInfo'])->middleware(TokenVerificationMiddleware::class);



// Page Routes (User Controller)
    Route::get('signin', [UserController::class, 'userSigninPage']);
});



// Route for Website