<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Controllers\WebsiteInformationController;




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
    Route::get('retriveAllUserInfo', [EducationController::class, 'retriveAllUserInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveUserInfoById', [EducationController::class, 'retriveUserInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteUserInfo', [EducationController::class, 'deleteUserInfo'])->middleware(TokenVerificationMiddleware::class);


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
    Route::get('retriveAllInterestInfo', [InterestController::class, 'retriveAllInterestInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveInterestInfoById', [InterestController::class, 'retriveInterestInfoById'])->middleware(TokenVerificationMiddleware::class);
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
    Route::get('retrivePostInfoBySlug/{slug}', [PostController::class, 'retrivePostInfoBySlug'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retrivePreviousPostInfoById', [PostController::class, 'retrivePreviousPostInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveNextPostInfoById', [PostController::class, 'retriveNextPostInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveLatestPostInfo', [PostController::class, 'retriveLatestPostInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Award Controller)
    Route::post('addAwardInfo', [AwardController::class, 'addAwardInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateAwardInfo', [AwardController::class, 'updateAwardInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllAwardInfo', [AwardController::class, 'retriveAllAwardInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAwardInfoById', [AwardController::class, 'retriveAwardInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteAwardInfo', [AwardController::class, 'deleteAwardInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Social Media Controller)
    Route::post('addSocialMediaInfo', [SocialMediaController::class, 'addSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateSocialMediaInfo', [SocialMediaController::class, 'updateSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllSocialMediaInfo', [SocialMediaController::class, 'retriveAllSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveSocialMediaInfoById', [SocialMediaController::class, 'retriveSocialMediaInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveSpecificSocialMediaInfo', [SocialMediaController::class, 'retriveSpecificSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteSocialMediaInfo', [SocialMediaController::class, 'deleteSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Portfolio Controller)
    Route::post('addPortfolioInfo', [PortfolioController::class, 'addPortfolioInfo']);
    Route::post('updatePortfolioInfo', [PortfolioController::class, 'updatePortfolioInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllPortfolioInfo', [PortfolioController::class, 'retriveAllPortfolioInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retrivePortfolioInfoById', [PortfolioController::class, 'retrivePortfolioInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deletePortfolioInfo', [PortfolioController::class, 'deletePortfolioInfo'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (Message Controller)
    Route::post('sendMessageFromWebsite', [MessageController::class, 'sendMessageFromWebsite']);
    Route::post('sendMessageFromAdmin', [MessageController::class, 'sendMessageFromAdmin'])->middleware(TokenVerificationMiddleware::class);
    Route::post('replyMessageFromAdmin', [MessageController::class, 'replyMessageFromAdmin'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveMessageById', [MessageController::class, 'retriveMessageById'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllMessage', [MessageController::class, 'retriveAllMessage'])->middleware(TokenVerificationMiddleware::class);
    Route::delete('deleteMessage', [MessageController::class, 'deleteMessage'])->middleware(TokenVerificationMiddleware::class);


    // API Routes (WebsiteInformation Controller)
    Route::get('retrieveLogoInfo', [WebsiteInformationController::class, 'retrieveLogoInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::post('addLogoInfo', [WebsiteInformationController::class, 'addLogoInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::put('updateLogoInfo', [WebsiteInformationController::class, 'updateLogoInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllSeoPropertyInfo', [WebsiteInformationController::class, 'retriveAllSeoPropertyInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveSeoPropertyInfoById', [WebsiteInformationController::class, 'retriveSeoPropertyInfoById'])->middleware(TokenVerificationMiddleware::class);
    Route::get('retriveAllVisitorInfo', [WebsiteInformationController::class, 'retriveAllVisitorInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::post('updateSeoPropertyInfo', [WebsiteInformationController::class, 'updateSeoPropertyInfo'])->middleware(TokenVerificationMiddleware::class);
    Route::get('dashboardSummaryInfo', [WebsiteInformationController::class, 'dashboardSummaryInfo'])->middleware(TokenVerificationMiddleware::class);




// Page Routes (User Controller)
    Route::get('signin', [UserController::class, 'userSigninPage']);
    Route::view('/testfile', 'jsondata');
    Route::view('/dashboard', 'admin.pages.dashboard');
    Route::view('/award', 'admin.pages.award');
    Route::view('/seoproperty', 'admin.pages.seoproperty');
    Route::view('/visitor_information', 'admin.pages.visitorinfo');
    Route::view('/basic_information', 'admin.pages.basicinfo');
    Route::view('/education', 'admin.pages.education');
    Route::view('/skill', 'admin.pages.skill');
    Route::view('/experience', 'admin.pages.experience');
    Route::view('/interest', 'admin.pages.interest');
    Route::view('/social_media', 'admin.pages.social_media');
    Route::view('/service', 'admin.pages.services');
});



// Route for Website
Route::post('/upload', [PortfolioController::class, 'upload']);