<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    /* Method for about information insert */

    public function addAboutInfo(Request $request){
        try{
            if($request->hasFile('hero_image')){
                $heroImage = $request->file('hero_image');

                /* Merge hero image into array */
                $aboutData = array_merge($request->input(), ['hero_image' => $heroImage]);
                
                $about = About::except('about_image')->create($aboutData);

                /* Store hero image into storage/public/profile_picture folder */
                if($about){
                    $heroImage->store('website_pictures/hero', 'public');
                }
            } elseif($request->hasFile('about_image')){
                $aboutImage = $request->file('about_image');

                /* Merge hero image into array */
                $aboutData = array_merge($request->input(), ['about_image' => $aboutImage]);
                
                $about = About::except('hero_image')->create($aboutData);

                /* Store hero image into storage/public/profile_picture folder */
                if($about){
                    $aboutImage->store('website_pictures/about', 'public');
                }
            } else{
                About::create($request->input());
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'Welcome! new account created'
            ]);
        } catch(Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'message' => 'Signup failed'.$e->getMessage()
            ]);
        }
    }
}
