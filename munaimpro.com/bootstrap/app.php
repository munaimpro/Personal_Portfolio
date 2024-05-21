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
            'Admin/retriveAllUserInfo',
            'Admin/retriveUserInfoById',
            'Admin/addAboutInfo',
            'Admin/updateAboutInfo',
            'Admin/retriveAboutInfo',
            'Admin/addEducationInfo',
            'Admin/updateEducationInfo',
            'Admin/retriveAllEducationInfo',
            'Admin/retriveEducationInfoById',
            'Admin/deleteEducationInfo',
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
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
