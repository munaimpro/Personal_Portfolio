<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
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

                /* Store hero image into storage/public/profile_picture folder */
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
        try{
            $aboutId = About::pluck('id')->first();

            if($request->hasFile('hero_image') && $request->hasFile('about_image')){
                // Retrive hero image link from database
                $getPreviousHeroImage = About::where('id', '=', $aboutId)->first('hero_image');

                // Remove hero file from storage
                if($getPreviousHeroImage){
                    if(Storage::exists("public/website_pictures/hero/".$getPreviousHeroImage->hero_image)){
                        Storage::delete("public/website_pictures/hero/".$getPreviousHeroImage->hero_image);
                    }
                }

                // Getting new hero file
                $heroImage = $request->file('hero_image');

                /* Extract the original file name with extension */
                $heroImageName = $heroImage->getClientOriginalName();

                // Retrive about image link from database
                $getPreviousAboutImage = About::where('id', '=', $aboutId)->first('about_image');

                // Remove about file from storage
                if($getPreviousAboutImage){
                    if(Storage::exists("public/website_pictures/about/".$getPreviousAboutImage->about_image)){
                        Storage::delete("public/website_pictures/about/".$getPreviousAboutImage->about_image);
                    }
                }

                // Getting new about file
                $aboutImage = $request->file('about_image');

                /* Extract the original file name with extension */
                $aboutImageName = $aboutImage->getClientOriginalName();

                $aboutData = array_merge($request->input(), ['hero_image' => $heroImageName, 'about_image' => $aboutImageName]);

                $about = About::where('id', '=', $aboutId)->update($aboutData);

                if($about){
                    $heroImage->storeAs('website_pictures/hero', $heroImageName, 'public');
                    $aboutImage->storeAs('website_pictures/about', $aboutImageName, 'public');
                }

            } elseif($request->hasFile('hero_image')){
                // Retrive hero image link from database
                $getPreviousHeroImage = About::where('id', '=', $aboutId)->first('hero_image');

                // Remove hero file from storage
                if($getPreviousHeroImage){
                    if(Storage::exists("public/website_pictures/hero/".$getPreviousHeroImage->hero_image)){
                        Storage::delete("public/website_pictures/hero/".$getPreviousHeroImage->hero_image);
                    }
                }

                // Getting new hero file
                $heroImage = $request->file('hero_image');

                /* Extract the original file name with extension */
                $heroImageName = $heroImage->getClientOriginalName();

                $aboutData = array_merge($request->input(), ['hero_image' => $heroImageName]);

                $about = About::where('id', '=', $aboutId)->update($aboutData);

                if($about){
                    $heroImage->storeAs('website_pictures/hero', $heroImageName, 'public');
                }

            } elseif($request->hasFile('about_image')){
                // Retrive about image link from database
                $getPreviousAboutImage = About::where('id', '=', $aboutId)->first('about_image');

                // Remove about file from storage
                if($getPreviousAboutImage){
                    if(Storage::exists("public/website_pictures/about/".$getPreviousAboutImage->about_image)){
                        Storage::delete("public/website_pictures/about/".$getPreviousAboutImage->about_image);
                    }
                }

                // Getting new about file
                $aboutImage = $request->file('about_image');

                /* Extract the original file name with extension */
                $aboutImageName = $aboutImage->getClientOriginalName();

                $aboutData = array_merge($request->input(), ['about_image' => $aboutImageName]);

                $about = About::where('id', '=', $aboutId)->update($aboutData);

                if($about){
                    $aboutImage->storeAs('website_pictures/about', $aboutImageName, 'public');
                }

            } else{
                About::where('id', '=', $aboutId)->update($request->input());
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'About information updated successfully'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'.$e->getMessage()
            ]);
        }
    }



    /* Method for about information retrive */

    public function retriveAboutInfo(Request $request){
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
