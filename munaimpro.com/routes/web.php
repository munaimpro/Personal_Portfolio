<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
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
    Route::put('userUpdateProfile', [UserController::class, 'updateProfile'])->middleware(TokenVerificationMiddleware::class);


// API Routes (About Controller)
    Route::post('addAboutInfo', [AboutController::class, 'addAboutInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateAboutInfo', [AboutController::class, 'updateAboutInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAboutInfo', [AboutController::class, 'retriveAboutInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Education Controller)
    Route::post('addEducationInfo', [EducationController::class, 'addEducationInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateEducationInfo', [EducationController::class, 'updateEducationInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllEducationInfo', [EducationController::class, 'retriveAllEducationInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveEducationInfoById', [EducationController::class, 'retriveEducationInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteEducationInfo', [EducationController::class, 'deleteEducationInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Skill Controller)
    Route::post('addSkillInfo', [SkillController::class, 'addSkillInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateSkillInfo', [SkillController::class, 'updateSkillInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllSkillInfo', [SkillController::class, 'retriveAllSkillInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveSkillInfoById', [SkillController::class, 'retriveSkillInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteSkillInfo', [SkillController::class, 'deleteSkillInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Interest Controller)
    Route::post('addInterestInfo', [InterestController::class, 'addInterestInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateInterestInfo', [InterestController::class, 'updateInterestInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllInterestInfo', [InterestController::class, 'retriveInterestInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveInterestInfoById', [InterestController::class, 'retriveInterestInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteInterestInfo', [InterestController::class, 'deleteInterestInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Category Controller)
    Route::post('addCategoryInfo', [CategoryController::class, 'addCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateCategoryInfo', [CategoryController::class, 'updateCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllCategoryInfo', [CategoryController::class, 'retriveAllCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveCategoryInfoById', [CategoryController::class, 'retriveCategoryInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteCategoryInfo', [CategoryController::class, 'deleteCategoryInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Experience Controller)
    Route::post('addExperienceInfo', [ExperienceController::class, 'addExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateExperienceInfo', [ExperienceController::class, 'updateExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllExperienceInfo', [ExperienceController::class, 'retriveAllExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveExperienceInfoById', [ExperienceController::class, 'retriveExperienceInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteExperienceInfo', [ExperienceController::class, 'deleteExperienceInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Service Controller)
    Route::post('addServiceInfo', [ServiceController::class, 'addServiceInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateServiceInfo', [ServiceController::class, 'updateServiceInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllServiceInfo', [ServiceController::class, 'retriveAllServiceInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveServiceInfoById', [ServiceController::class, 'retriveServiceInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteServiceInfo', [ServiceController::class, 'deleteServiceInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Post Controller)
    Route::post('addPostInfo', [PostController::class, 'addPostInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updatePostInfo', [PostController::class, 'updatePostInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllPostInfo', [PostController::class, 'retriveAllPostInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retrivePostInfoById', [PostController::class, 'retrivePostInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deletePostInfo', [PostController::class, 'deletePostInfo'])->middleware(TokenVerificationMiddleware::class);



// Page Routes (User Controller)
    Route::get('signin', [UserController::class, 'userSigninPage']);
});



// Route for Website