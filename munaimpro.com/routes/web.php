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
 * API Routes for Admin Panel and Website
*/

// API Routes (User Controller)
Route::post('userSignup', [UserController::class, 'userSignup']);
Route::post('userSignin', [UserController::class, 'userSignin']);
Route::get('userSignout', [UserController::class, 'userSignout']);
Route::post('userSendOTP', [UserController::class, 'sendOTPCode']);
Route::post('userOTPVerification', [UserController::class, 'verifyOTPCode']);
Route::post('userResetPassword', [UserController::class, 'resetPassword'])->middleware(TokenVerificationMiddleware::class);
Route::get('userProfile', [UserController::class, 'userProfile'])->middleware(TokenVerificationMiddleware::class);
Route::post('userUpdateProfile', [UserController::class, 'updateProfile'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllUserInfo', [EducationController::class, 'retriveAllUserInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveUserInfoById', [EducationController::class, 'retriveUserInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteUserInfo', [EducationController::class, 'deleteUserInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (About Controller)
Route::post('addAboutInfo', [AboutController::class, 'addAboutInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('updateAboutInfo', [AboutController::class, 'updateAboutInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAboutInfo', [AboutController::class, 'retriveAboutInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Education Controller)
Route::post('addEducationInfo', [EducationController::class, 'addEducationInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateEducationInfo', [EducationController::class, 'updateEducationInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllEducationInfo', [EducationController::class, 'retriveAllEducationInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveEducationInfoById', [EducationController::class, 'retriveEducationInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteEducationInfo', [EducationController::class, 'deleteEducationInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Skill Controller)
Route::post('addSkillInfo', [SkillController::class, 'addSkillInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateSkillInfo', [SkillController::class, 'updateSkillInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllSkillInfo', [SkillController::class, 'retriveAllSkillInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveSkillInfoById', [SkillController::class, 'retriveSkillInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteSkillInfo', [SkillController::class, 'deleteSkillInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Interest Controller)
Route::post('addInterestInfo', [InterestController::class, 'addInterestInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateInterestInfo', [InterestController::class, 'updateInterestInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllInterestInfo', [InterestController::class, 'retriveAllInterestInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveInterestInfoById', [InterestController::class, 'retriveInterestInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteInterestInfo', [InterestController::class, 'deleteInterestInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Category Controller)
Route::post('addCategoryInfo', [CategoryController::class, 'addCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateCategoryInfo', [CategoryController::class, 'updateCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllCategoryInfo', [CategoryController::class, 'retriveAllCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveCategoryInfoById', [CategoryController::class, 'retriveCategoryInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteCategoryInfo', [CategoryController::class, 'deleteCategoryInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Experience Controller)
Route::post('addExperienceInfo', [ExperienceController::class, 'addExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateExperienceInfo', [ExperienceController::class, 'updateExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllExperienceInfo', [ExperienceController::class, 'retriveAllExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveExperienceInfoById', [ExperienceController::class, 'retriveExperienceInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteExperienceInfo', [ExperienceController::class, 'deleteExperienceInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Service Controller)
Route::post('addServiceInfo', [ServiceController::class, 'addServiceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateServiceInfo', [ServiceController::class, 'updateServiceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllServiceInfo', [ServiceController::class, 'retriveAllServiceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveServiceInfoById', [ServiceController::class, 'retriveServiceInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteServiceInfo', [ServiceController::class, 'deleteServiceInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Post Controller)
Route::post('addPostInfo', [PostController::class, 'addPostInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('publishSchedulePost', [PostController::class, 'publishSchedulePost'])->middleware(TokenVerificationMiddleware::class);
Route::post('updatePostInfo', [PostController::class, 'updatePostInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllPostInfo', [PostController::class, 'retriveAllPostInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrivePostInfoById', [PostController::class, 'retrivePostInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deletePostInfo', [PostController::class, 'deletePostInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrivePostInfoBySlug/{slug}', [PostController::class, 'retrivePostInfoBySlug'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrivePreviousPostInfoById', [PostController::class, 'retrivePreviousPostInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveNextPostInfoById', [PostController::class, 'retriveNextPostInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveLatestPostInfo', [PostController::class, 'retriveLatestPostInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Award Controller)
Route::post('addAwardInfo', [AwardController::class, 'addAwardInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateAwardInfo', [AwardController::class, 'updateAwardInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllAwardInfo', [AwardController::class, 'retriveAllAwardInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveAwardInfoById', [AwardController::class, 'retriveAwardInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteAwardInfo', [AwardController::class, 'deleteAwardInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Social Media Controller)
Route::post('addSocialMediaInfo', [SocialMediaController::class, 'addSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateSocialMediaInfo', [SocialMediaController::class, 'updateSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllSocialMediaInfo', [SocialMediaController::class, 'retriveAllSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveSocialMediaInfoById', [SocialMediaController::class, 'retriveSocialMediaInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveSpecificSocialMediaInfo', [SocialMediaController::class, 'retriveSpecificSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteSocialMediaInfo', [SocialMediaController::class, 'deleteSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Portfolio Controller)
Route::post('addPortfolioInfo', [PortfolioController::class, 'addPortfolioInfo']);
Route::post('updatePortfolioInfo', [PortfolioController::class, 'updatePortfolioInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllPortfolioInfo', [PortfolioController::class, 'retriveAllPortfolioInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrivePortfolioInfoById', [PortfolioController::class, 'retrivePortfolioInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deletePortfolioInfo', [PortfolioController::class, 'deletePortfolioInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('removePortfolioUiImage', [PortfolioController::class, 'removePortfolioUiImage'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Message Controller)
Route::post('sendMessageFromWebsite', [MessageController::class, 'sendMessageFromWebsite']);
Route::post('sendMessageFromAdmin', [MessageController::class, 'sendMessageFromAdmin'])->middleware(TokenVerificationMiddleware::class);
Route::post('replyMessageFromAdmin', [MessageController::class, 'replyMessageFromAdmin'])->middleware(TokenVerificationMiddleware::class);
Route::post('retriveMessageInfoById', [MessageController::class, 'retriveMessageInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllMessageInfo', [MessageController::class, 'retriveAllMessageInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteMessageInfo', [MessageController::class, 'deleteMessageInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (WebsiteInformation Controller)
Route::get('retrieveLogoInfo', [WebsiteInformationController::class, 'retrieveLogoInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('addLogoInfo', [WebsiteInformationController::class, 'addLogoInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateLogoInfo', [WebsiteInformationController::class, 'updateLogoInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllSeoPropertyInfo', [WebsiteInformationController::class, 'retriveAllSeoPropertyInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveSeoPropertyInfoById', [WebsiteInformationController::class, 'retriveSeoPropertyInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::get('retriveAllVisitorInfo', [WebsiteInformationController::class, 'retriveAllVisitorInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('updateSeoPropertyInfo', [WebsiteInformationController::class, 'updateSeoPropertyInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('dashboardSummaryInfo', [WebsiteInformationController::class, 'dashboardSummaryInfo'])->middleware(TokenVerificationMiddleware::class);




/**
 * Page Route for Admin Panel
*/

Route::group(['prefix' => 'Admin', 'middleware' => TokenVerificationMiddleware::class], function(){
    // Page Routes (User Controller)
    Route::get('/signup', [UserController::class, 'userSignupPage']);
    Route::get('/signin', [UserController::class, 'userSigninPage']);
    Route::get('/sendotp', [UserController::class, 'sendOtpPage']);
    Route::get('/verifyotp', [UserController::class, 'verifyOtpPage']);
    Route::get('/password_reset', [UserController::class, 'resetPasswordPage']);
    Route::get('/profile', [UserController::class, 'userProfilePage']);
    
    // Page Routes (Website Controller)
    Route::get('/dashboard', [WebsiteinformationController::class, 'adminDashboardPage']);
    
    // Page Routes (Award Controller)
    Route::get('/award', [AwardController::class, 'adminAwardPage']);
    
    Route::view('/seoproperty', 'admin.pages.seoproperty');
    Route::view('/visitor_information', 'admin.pages.visitorinfo');

    // Page Routes (About Controller)
    Route::get('/about', [AboutController::class, 'aboutInfoPage']);

    // Page Routes (Education Controller)
    Route::get('/education', [EducationController::class, 'adminEducationPage']);

    // Page Routes (Skill Controller)
    Route::get('/skill', [SkillController::class, 'adminSkillPage']);

    // Page Routes (Experience Controller)
    Route::get('/experience', [ExperienceController::class, 'adminExperiencePage']);

    // Page Routes (Interest Controller)
    Route::get('/interest', [InterestController::class, 'adminInterestPage']);

    // Page Routes (SocialMedia Controller)
    Route::get('/social_media', [SocialMediaController::class, 'adminSocialMediaPage']);

    // Page Routes (Service Controller)
    Route::get('/service', [ServiceController::class, 'adminServicePage']);

    // Page Routes (Portfolio Controller)
    Route::get('/portfolio', [PortfolioController::class, 'adminPortfolioPage']);

    Route::view('/pricing', 'admin.pages.pricing');

    // Page Routes (Service Controller)
    Route::get('/message', [MessageController::class, 'adminMessagePage']);

    // Page Routes (Service Controller)
    Route::get('/category', [CategoryController::class, 'adminCategoryPage']);

    // Page Routes (Post Controller)
    Route::get('/post', [PostController::class, 'adminPostPage']);
    
    Route::view('/user', 'admin.pages.user');
});




/**
 * Page Route for Website
*/
