<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\ClientFeedbackController;
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
Route::get('retrieveAllUserInfo', [UserController::class, 'retrieveAllUserInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrieveUserInfoById', [UserController::class, 'retrieveUserInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::post('updateUserInfo', [UserController::class, 'updateUserInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteUserInfo', [UserController::class, 'deleteUserInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (About Controller)
Route::post('addAboutInfo', [AboutController::class, 'addAboutInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('updateAboutInfo', [AboutController::class, 'updateAboutInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAboutInfo', [AboutController::class, 'retrieveAboutInfo']);


// API Routes (Education Controller)
Route::post('addEducationInfo', [EducationController::class, 'addEducationInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateEducationInfo', [EducationController::class, 'updateEducationInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllEducationInfo', [EducationController::class, 'retrieveAllEducationInfo']);
Route::post('retrieveEducationInfoById', [EducationController::class, 'retrieveEducationInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteEducationInfo', [EducationController::class, 'deleteEducationInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Skill Controller)
Route::post('addSkillInfo', [SkillController::class, 'addSkillInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateSkillInfo', [SkillController::class, 'updateSkillInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllSkillInfo', [SkillController::class, 'retrieveAllSkillInfo']);
Route::post('retrieveSkillInfoById', [SkillController::class, 'retrieveSkillInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteSkillInfo', [SkillController::class, 'deleteSkillInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Interest Controller)
Route::post('addInterestInfo', [InterestController::class, 'addInterestInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateInterestInfo', [InterestController::class, 'updateInterestInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllInterestInfo', [InterestController::class, 'retrieveAllInterestInfo']);
Route::post('retrieveInterestInfoById', [InterestController::class, 'retrieveInterestInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteInterestInfo', [InterestController::class, 'deleteInterestInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Category Controller)
Route::post('addCategoryInfo', [CategoryController::class, 'addCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateCategoryInfo', [CategoryController::class, 'updateCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllCategoryInfo', [CategoryController::class, 'retrieveAllCategoryInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrieveCategoryInfoById', [CategoryController::class, 'retrieveCategoryInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteCategoryInfo', [CategoryController::class, 'deleteCategoryInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Experience Controller)
Route::post('addExperienceInfo', [ExperienceController::class, 'addExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateExperienceInfo', [ExperienceController::class, 'updateExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllExperienceInfo', [ExperienceController::class, 'retrieveAllExperienceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrieveExperienceInfoById', [ExperienceController::class, 'retrieveExperienceInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteExperienceInfo', [ExperienceController::class, 'deleteExperienceInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Service Controller)
Route::post('addServiceInfo', [ServiceController::class, 'addServiceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateServiceInfo', [ServiceController::class, 'updateServiceInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllServiceInfo', [ServiceController::class, 'retrieveAllServiceInfo']);
Route::post('retrieveServiceInfoById', [ServiceController::class, 'retrieveServiceInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteServiceInfo', [ServiceController::class, 'deleteServiceInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Post Controller)
Route::post('addPostInfo', [PostController::class, 'addPostInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('publishSchedulePost', [PostController::class, 'publishSchedulePost'])->middleware(TokenVerificationMiddleware::class);
Route::post('updatePostInfo', [PostController::class, 'updatePostInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllPostInfo', [PostController::class, 'retrieveAllPostInfo']);
Route::post('retrievePostInfoById', [PostController::class, 'retrievePostInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deletePostInfo', [PostController::class, 'deletePostInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrievePostInfoBySlug/{slug}', [PostController::class, 'retrievePostInfoBySlug']);
Route::get('retrievePreviousPostInfoById', [PostController::class, 'retrievePreviousPostInfoById']);
Route::get('retrieveNextPostInfoById', [PostController::class, 'retrieveNextPostInfoById']);
Route::get('retrieveLatestPostInfo', [PostController::class, 'retrieveLatestPostInfo']);


// API Routes (Award Controller)
Route::post('addAwardInfo', [AwardController::class, 'addAwardInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateAwardInfo', [AwardController::class, 'updateAwardInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllAwardInfo', [AwardController::class, 'retrieveAllAwardInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrieveAwardInfoById', [AwardController::class, 'retrieveAwardInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteAwardInfo', [AwardController::class, 'deleteAwardInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Social Media Controller)
Route::post('addSocialMediaInfo', [SocialMediaController::class, 'addSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
Route::put('updateSocialMediaInfo', [SocialMediaController::class, 'updateSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllSocialMediaInfo', [SocialMediaController::class, 'retrieveAllSocialMediaInfo']);
Route::post('retrieveSocialMediaInfoById', [SocialMediaController::class, 'retrieveSocialMediaInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveSpecificSocialMediaInfo', [SocialMediaController::class, 'retrieveSpecificSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteSocialMediaInfo', [SocialMediaController::class, 'deleteSocialMediaInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Portfolio Controller)
Route::post('addPortfolioInfo', [PortfolioController::class, 'addPortfolioInfo']);
Route::post('updatePortfolioInfo', [PortfolioController::class, 'updatePortfolioInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllPortfolioInfo', [PortfolioController::class, 'retrieveAllPortfolioInfo']);
Route::post('retrievePortfolioInfoById', [PortfolioController::class, 'retrievePortfolioInfoById']);
Route::delete('deletePortfolioInfo', [PortfolioController::class, 'deletePortfolioInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('removePortfolioUiImage', [PortfolioController::class, 'removePortfolioUiImage'])->middleware(TokenVerificationMiddleware::class);
Route::post('/generateFeedbackUrl', [PortfolioController::class, 'generateFeedbackUrl']);


// API Routes (Message Controller)
Route::post('sendMessageFromWebsite', [MessageController::class, 'sendMessageFromWebsite']);
Route::post('sendMessageFromAdmin', [MessageController::class, 'sendMessageFromAdmin'])->middleware(TokenVerificationMiddleware::class);
Route::post('replyMessageFromAdmin', [MessageController::class, 'replyMessageFromAdmin'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrieveMessageInfoById', [MessageController::class, 'retrieveMessageInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllMessageInfo', [MessageController::class, 'retrieveAllMessageInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteMessageInfo', [MessageController::class, 'deleteMessageInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (WebsiteInformation Controller)
Route::get('retrieveLogoInfo', [WebsiteInformationController::class, 'retrieveLogoInfo']);
Route::post('addLogoInfo', [WebsiteInformationController::class, 'addLogoInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('updateLogoInfo', [WebsiteInformationController::class, 'updateLogoInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('retreiveAllSeoPropertyInfo', [WebsiteInformationController::class, 'retreiveAllSeoPropertyInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrieveSeoPropertyInfoById', [WebsiteInformationController::class, 'retrieveSeoPropertyInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::get('retrieveAllVisitorInfo', [WebsiteInformationController::class, 'retrieveAllVisitorInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('retrieveVisitorInfoById', [WebsiteInformationController::class, 'retrieveVisitorInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::post('updateSeoPropertyInfo', [WebsiteInformationController::class, 'updateSeoPropertyInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteSeoPropertyInfo', [WebsiteInformationController::class, 'deleteSeoPropertyInfo'])->middleware(TokenVerificationMiddleware::class);
Route::post('/trackVisitorInformation', [WebsiteInformationController::class, 'trackVisitorInformation']);


// API Routes (Dashboard Controller)
Route::get('dashboardStatInfo', [DashboardController::class, 'dashboardStatInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('dashboardLatestProjectInfo', [DashboardController::class, 'dashboardLatestProjectInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('dashboardLatestPostInfo', [DashboardController::class, 'dashboardLatestPostInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('dashboardVisitorCountryInfo', [DashboardController::class, 'dashboardVisitorCountryInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('dashboardLatestVisitorInfo', [DashboardController::class, 'dashboardLatestVisitorInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('dashboardVisitorBrowserUsageInfo', [DashboardController::class, 'dashboardVisitorBrowserUsageInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('dashboardLatestUserInfo', [DashboardController::class, 'dashboardLatestUserInfo'])->middleware(TokenVerificationMiddleware::class);
Route::get('dashboardNewMessageInfo', [DashboardController::class, 'dashboardNewMessageInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (ClientFeedback Controller)
Route::post('addClientFeedbackInfo', [ClientFeedbackController::class, 'addClientFeedbackInfo']);
Route::get('retrieveAllClientFeedbackInfo', [ClientFeedbackController::class, 'retrieveAllClientFeedbackInfo']);
Route::post('retrieveClientFeedbackInfoById', [ClientFeedbackController::class, 'retrieveClientFeedbackInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deleteClientFeedbackInfo', [ClientFeedbackController::class, 'deleteClientFeedbackInfo'])->middleware(TokenVerificationMiddleware::class);


// API Routes (Pricing Controller)
Route::post('addPricingInfo', [PricingController::class, 'addPricingInfo']);
Route::get('retrieveAllPricingInfo', [PricingController::class, 'retrieveAllPricingInfo']);
Route::post('retrievePricingInfoById', [PricingController::class, 'retrievePricingInfoById'])->middleware(TokenVerificationMiddleware::class);
Route::post('updatePricingInfo', [PricingController::class, 'updatePricingInfo'])->middleware(TokenVerificationMiddleware::class);
Route::delete('deletePricingInfo', [PricingController::class, 'deletePricingInfo'])->middleware(TokenVerificationMiddleware::class);




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
    Route::get('/user', [UserController::class, 'adminUserPage']);
    
    // Page Route (Dashboard Controller)
    Route::get('/dashboard', [DashboardController::class, 'adminDashboardPage']);
    
    // Page Route (Award Controller)
    Route::get('/award', [AwardController::class, 'adminAwardPage']);
    
    // Page Route (WebsiteInformation Controller)
    Route::get('/seoproperty', [WebsiteInformationController::class, 'adminLogoWithSEOPropertyPage']);
    
    // Page Route (WebsiteInformation Controller)
    Route::get('/visitorinfo', [WebsiteInformationController::class, 'adminVisitorInformationPage']);

    // Page Route (About Controller)
    Route::get('/about', [AboutController::class, 'aboutInfoPage']);

    // Page Route (Education Controller)
    Route::get('/education', [EducationController::class, 'adminEducationPage']);

    // Page Route (Skill Controller)
    Route::get('/skill', [SkillController::class, 'adminSkillPage']);

    // Page Route (Experience Controller)
    Route::get('/experience', [ExperienceController::class, 'adminExperiencePage']);

    // Page Route (Interest Controller)
    Route::get('/interest', [InterestController::class, 'adminInterestPage']);

    // Page Route (SocialMedia Controller)
    Route::get('/social_media', [SocialMediaController::class, 'adminSocialMediaPage']);

    // Page Route (Service Controller)
    Route::get('/service', [ServiceController::class, 'adminServicePage']);

    // Page Route (Portfolio Controller)
    Route::get('/portfolio', [PortfolioController::class, 'adminPortfolioPage']);

    // Page Route (Pricing Controller)
    Route::get('/pricing', [PricingController::class, 'adminPricingPage']);

    // Page Route (Service Controller)
    Route::get('/message', [MessageController::class, 'adminMessagePage']);

    // Page Route (Service Controller)
    Route::get('/category', [CategoryController::class, 'adminCategoryPage']);

    // Page Route (Post Controller)
    Route::get('/post', [PostController::class, 'adminPostPage']);

    // Page Route (ClientFeedback Controller)
    Route::get('/client_feedback', [ClientFeedbackController::class, 'adminClientFeedbackPage']);
});

// Page Route (ClientFeedback Controller)
Route::get('/feedback/{token}', [ClientFeedbackController::class, 'clientFeedbackPage']);




/**
 * Page Route for Website
*/

// Page Route (Home Controller)
Route::get('/', [HomeController::class, 'websiteHomePage']);

// Page Route (About Controller)
Route::get('/about', [AboutController::class, 'websiteAboutPage']);

// Page Route (Service Controller)
Route::get('/services', [ServiceController::class, 'websiteServicePage']);

// Page Route (Portfolio Controller)
Route::get('/portfolio', [PortfolioController::class, 'websitePortfolioPage']);

// Page Route (Portfolio Controller)
Route::get('/portfolio/details/{id}', [PortfolioController::class, 'websitePortfolioDetailsPage']);

// Page Route (Pricing Controller)
Route::view('/pricing', 'website.pages.pricing');

// Page Route (Post Controller)
Route::get('/blog', [PostController::class, 'websiteBlogPage']);

// Page Route (Post Controller)
Route::get('/blog/{slug}', [PostController::class, 'websiteBlogDetailsPage']);

// Page Route (Message Controller)
Route::get('/contact', [MessageController::class, 'websiteContactPage']);