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
            
            'Admin/addSkillInfo',
            'Admin/updateSkillInfo',
            'Admin/retriveAllSkillInfo',
            'Admin/retriveSkillInfoById',
            'Admin/deleteSkillInfo',
            
            'Admin/addInterestInfo',
            'Admin/updateInterestInfo',
            'Admin/retriveAllInterestInfo',
            'Admin/retriveInterestInfoById',
            'Admin/deleteInterestInfo',
            
            'Admin/addCategoryInfo',
            'Admin/updateCategoryInfo',
            'Admin/retriveAllCategoryInfo',
            'Admin/retriveCategoryInfoById',
            'Admin/deleteCategoryInfo',
            
            'Admin/addExperienceInfo',
            'Admin/updateExperienceInfo',
            'Admin/retriveAllExperienceInfo',
            'Admin/retriveExperienceInfoById',
            'Admin/deleteExperienceInfo',

            'Admin/addServiceInfo',
            'Admin/updateServiceInfo',
            'Admin/retriveAllServiceInfo',
            'Admin/retriveServiceInfoById',
            'Admin/deleteServiceInfo',

            'Admin/addPostInfo',
            'Admin/updatePostInfo',
            'Admin/retriveAllPostInfo',
            'Admin/retrivePostInfoById',
            'Admin/deletePostInfo',
            'Admin/retrivePostInfoBySlug/{slug}',
            'Admin/retrivePreviousPostInfoById',
            'Admin/retriveNextPostInfoById',
            'Admin/retriveLatestPostInfo',

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
