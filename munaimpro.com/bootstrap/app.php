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
            'userSignup',
            'userSignin',
            'userSignout',
            'userSendOTP',
            'userOTPVerification',
            'userResetPassword',
            'userProfile',
            'userUpdateProfile',
            'retriveAllUserInfo',
            'retriveUserInfoById',
            
            'addAboutInfo',
            'updateAboutInfo',
            'retriveAboutInfo',
            
            'addEducationInfo',
            'updateEducationInfo',
            'retriveAllEducationInfo',
            'retriveEducationInfoById',
            'deleteEducationInfo',
            
            'addSkillInfo',
            'updateSkillInfo',
            'retriveAllSkillInfo',
            'retriveSkillInfoById',
            'deleteSkillInfo',
            
            'addInterestInfo',
            'updateInterestInfo',
            'retriveAllInterestInfo',
            'retriveInterestInfoById',
            'deleteInterestInfo',
            
            'addCategoryInfo',
            'updateCategoryInfo',
            'retriveAllCategoryInfo',
            'retriveCategoryInfoById',
            'deleteCategoryInfo',
            
            'addExperienceInfo',
            'updateExperienceInfo',
            'retriveAllExperienceInfo',
            'retriveExperienceInfoById',
            'deleteExperienceInfo',

            'addServiceInfo',
            'updateServiceInfo',
            'retriveAllServiceInfo',
            'retriveServiceInfoById',
            'deleteServiceInfo',

            'addPostInfo',
            'updatePostInfo',
            'retriveAllPostInfo',
            'retrivePostInfoById',
            'deletePostInfo',
            'retrivePostInfoBySlug/{slug}',
            'retrivePreviousPostInfoById',
            'retriveNextPostInfoById',
            'retriveLatestPostInfo',

            'addAwardInfo',
            'updateAwardInfo',
            'retriveAllAwardInfo',
            'retriveAwardInfoById',
            'deleteAwardInfo',

            'addSocialMediaInfo',
            'updateSocialMediaInfo',
            'retriveAllSocialMediaInfo',
            'retriveSocialMediaInfoById',
            'retriveSpecificSocialMediaInfo',
            'deleteSocialMediaInfo',

            'addPortfolioInfo',
            'updatePortfolioInfo',
            'retriveAllPortfolioInfo',
            'retrivePortfolioInfoById',
            'deletePortfolioInfo',
            'generateFeedbackUrl',

            'sendMessageFromWebsite',
            'sendMessageFromAdmin',
            'replyMessageFromAdmin',
            'retriveMessageById',
            'retriveAllMessage',
            'deleteMessage',

            'retrieveLogoInfo',
            'addLogoInfo',
            'updateLogoInfo',
            'retriveAllSeoPropertyInfo',
            'retriveSeoPropertyInfoById',
            'retriveAllVisitorInfo',
            'updateSeoPropertyInfo',
            'dashboardSummaryInfo',




            'upload',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
