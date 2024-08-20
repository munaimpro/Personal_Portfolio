<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\About;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /* Method for signup page load */
    
    public function aboutInfoPage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.basicinfo', compact(['seoproperty', 'routeName']));
    }


    
    /* Method for about information insert */

    public function addAboutInfo(Request $request){
        try{
            if($request->hasFile('hero_image') && $request->hasFile('about_image')){
                /* Getting file */
                $heroImage = $request->file('hero_image');
                $aboutImage = $request->file('about_image');

                /* Extract the original file name with extension */
                $heroImageName = $heroImage->getClientOriginalName();
                $aboutImageName = $aboutImage->getClientOriginalName();

                /* Merge hero and about image into array */
                $aboutData = array_merge($request->input(), ['hero_image' => $heroImageName, 'about_image' => $aboutImageName]);
                
                $about = About::create($aboutData);

                /* Store hero image into storage/public/website_pictures folder */
                if ($about){
                    $heroImage->storeAs('website_pictures/hero', $heroImageName, 'public');
                    $aboutImage->storeAs('website_pictures/about', $aboutImageName, 'public');
                }
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'About information added'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'.$e->getMessage()
            ]);
        }
    }



    /* Method for about information update */

    public function updateAboutInfo(Request $request){

        // Input validation process for backend
        $validatedData = $request->validate([
            'greetings' => 'required|string|max:100',
            'full_name' => 'required|string|max:100',
            'designation' => 'required|string|max:100',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:15',
            'location' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'about_description' => 'required|string',
        ]);

        // dd($validatedData['phone']);
        // dd($validatedData['location']);
        // dd($validatedData['email']);

        try{
            // Start DB transaction
            DB::beginTransaction();

            $about = About::first();

            if($request->hasFile('hero_image')){
                // Validate hero image
                $request->validate(['hero_image' => 'image|mimes:jpeg,jpg,png|max:2048']);
                
                // Retrive hero image link from database
                $getPreviousHeroImage = About::where('id', '=', $about->id)->first('hero_image');

                // Remove hero file from storage
                if($getPreviousHeroImage){
                    if(Storage::exists("public/website_pictures/hero/".$getPreviousHeroImage->hero_image)){
                        Storage::delete("public/website_pictures/hero/".$getPreviousHeroImage->hero_image);
                    }
                }

                // Getting new hero image
                $heroImage = $request->file('hero_image');

                // Extract the original image name with extension
                $heroImageName = $heroImage->getClientOriginalName();

                // Assign hero image name to validated data
                $validatedData['hero_image'] = $heroImageName;
            }
            
            if($request->hasFile('about_image')){
                // Validate about image
                $request->validate(['about_image' => 'image|mimes:jpeg,jpg,png|max:2048']);
                
                // Retrive about image link from database
                $getPreviousAboutImage = About::where('id', '=', $about->id)->first('about_image');

                // Remove about file from storage
                if($getPreviousAboutImage){
                    if(Storage::exists("public/website_pictures/about/".$getPreviousAboutImage->about_image)){
                        Storage::delete("public/website_pictures/about/".$getPreviousAboutImage->about_image);
                    }
                }

                // Getting new about image
                $aboutImage = $request->file('about_image');

                // Extract the original image name with extension
                $aboutImageName = $aboutImage->getClientOriginalName();

                // Assign about image name to validated data
                $validatedData['about_image'] = $aboutImageName;
            }
            
            if($request->hasFile('resume_link')){
                // Validate about image
                $request->validate(['resume_link' => 'file|mimes:pdf|max:2048']);
                
                // Retrive resume link from database
                $getPreviousResumeLink = About::where('id', '=', $about->id)->first('resume_link');

                // Remove resume file from storage
                if($getPreviousResumeLink){
                    if(Storage::exists("public/resume/".$getPreviousResumeLink->resume_link)){
                        Storage::delete("public/resume/".$getPreviousResumeLink->resume_link);
                    }
                }

                // Getting new resume file
                $resumeFile = $request->file('resume_link');

                // Extract the original resume name with extension
                $resumeFileName = $resumeFile->getClientOriginalName();

                // Assign resume name to validated data
                $validatedData['resume_link'] = $resumeFileName;
            } 
            
            $aboutUpdate = $about->update($validatedData);

            if($aboutUpdate){
                if($request->hasFile('hero_image')){
                    $heroImage->storeAs('website_pictures/hero', $heroImageName, 'public');
                }

                if($request->hasFile('about_image')){
                    $aboutImage->storeAs('website_pictures/about', $aboutImageName, 'public');
                }

                if($request->hasFile('resume_link')){
                    $resumeFile->storeAs('resume', $resumeFileName, 'public');
                }
            }

            // Commit the transaction
            DB::commit();
        
            return response()->json([
                'status' => 'success',
                'message' => 'About information updated successfully'
            ]);
        } catch(Exception $e){
            // Rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'.$e->getMessage()
            ]);
        }
    }



    /* Method for about information retrive */

    public function retriveAboutInfo(){
        try{
            $aboutId = About::pluck('id')->first(); // Primary key id from about table
            
            $about = About::where('id', '=', $aboutId)->first(); // Getting about data by id

            if($about){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request success',
                    'data' => $about
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Data not found'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
    }
}
