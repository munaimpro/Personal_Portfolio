<?php

namespace App\Http\Controllers;

use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /* Method for website home page load */
    
    public function websiteHomePage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));
        
        // Getting SEO property
        $seoproperty = Seoproperty::where('page_name', 'index')->first();

        return view('website.pages.index', compact(['routeName', 'seoproperty']));
    }
}
