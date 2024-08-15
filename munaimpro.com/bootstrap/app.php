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
            'Admin/retriveAllExperienceInfo',
            'Admin/retriveExperienceInfoById',
            'Admin/deleteExperienceInfo',

            'Admin/addServiceInfo',
            'Admin/updateServiceInfo',
            'Admin/retriveAllServiceInfo',
            'Admin/retriveServiceInfoById',
            'Admin/deleteServiceInfo',

            'addPostInfo',
            'updatePostInfo',
            'retriveAllPostInfo',
            'retrivePostInfoById',
            'deletePostInfo',
            'retrivePostInfoBySlug/{slug}',
            'retrivePreviousPostInfoById',
            'retriveNextPostInfoById',
            'retriveLatestPostInfo',

            'Admin/addAwardInfo',
            'Admin/updateAwardInfo',
            'Admin/retriveAllAwardInfo',
            'Admin/retriveAwardInfoById',
            'Admin/deleteAwardInfo',

            'Admin/addSocialMediaInfo',
            'Admin/updateSocialMediaInfo',
            'Admin/retriveAllSocialMediaInfo',
            'Admin/retriveSocialMediaInfoById',
            'Admin/retriveSpecificSocialMediaInfo',
            'Admin/deleteSocialMediaInfo',

            'Admin/addPortfolioInfo',
            'Admin/updatePortfolioInfo',
            'Admin/retriveAllPortfolioInfo',
            'Admin/retrivePortfolioInfoById',
            'Admin/deletePortfolioInfo',

            'Admin/sendMessageFromWebsite',
            'Admin/sendMessageFromAdmin',
            'Admin/replyMessageFromAdmin',
            'Admin/retriveMessageById',
            'Admin/retriveAllMessage',
            'Admin/deleteMessage',

            'Admin/retrieveLogoInfo',
            'Admin/addLogoInfo',
            'Admin/updateLogoInfo',
            'Admin/retriveAllSeoPropertyInfo',
            'Admin/retriveSeoPropertyInfoById',
            'Admin/retriveAllVisitorInfo',
            'Admin/updateSeoPropertyInfo',
            'Admin/dashboardSummaryInfo',




            'upload',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
