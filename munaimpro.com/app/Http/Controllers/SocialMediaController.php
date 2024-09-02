<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Seoproperty;
use App\Models\SocialMedias;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class SocialMediaController extends Controller
{
    /* Method for admin social media page load */
    
    public function adminSocialMediaPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.social_media', compact(['routeName']));
    }


    /* Method for add social media information */

    public function addSocialMediaInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'social_media_title' => 'required|string|max:100',
                'social_media_link' => 'required|string|max:100',
                'social_media_icon' => 'required|string|max:50',
                'social_media_placement' => 'required|array',
                'social_media_placement.*' => ['nullable', Rule::in(['hero', 'contact', 'footer'])],
            ]);

            // Converting the array of placements to JSON
            $validatedData['social_media_placement'] = json_encode($request->input('social_media_placement'));
            
            $social_media = SocialMedias::create($validatedData);

            if($social_media){
                return response()->json([
                    'status' => 'success',
                    'message' => 'New social media added'
                ]);
            } else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }


    /* Method for update social media information */

    public function updateSocialMediaInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'social_media_title' => 'required|string|max:100',
                'social_media_link' => 'required|string|max:100',
                'social_media_icon' => 'required|string|max:50',
                'social_media_placement' => 'required|array',
                'social_media_placement.*' => ['nullable', Rule::in(['hero', 'contact', 'footer'])],
                'social_media_info_id' => 'required',
            ]);

            // Converting the array of placements to JSON
            $validatedData['social_media_placement'] = json_encode($request->input('social_media_placement'));
        
            $social_media = SocialMedias::findOrFail($validatedData['social_media_info_id']);
            $social_media->update($validatedData);

            if($social_media){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Social media details updated'
                ]);
            } else{
                return response()->json([
                    'status' => 'filed',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }


    /* Method for retrive all social media information */

    public function retriveAllSocialMediaInfo(){
        try{
            $social_media = SocialMedias::get(['id', 'social_media_title', 'social_media_link', 'social_media_icon', 'social_media_placement']); // Getting all social media data

            if($social_media){
                return response()->json([
                    'status' => 'success',
                    'message' => 'social media data found',
                    'data' => $social_media,
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }

    }


    /* Method for retrive social media information by id */

    public function retriveSocialMediaInfoById(Request $request){
        try{
            $socialMediaInfoId = $request->input('social_media_info_id'); // Primary key id from input
        
            $social_media = SocialMedias::findOrFail($socialMediaInfoId, ['id', 'social_media_title', 'social_media_link', 'social_media_icon', 'social_media_placement']); // Getting social media data by id

            if($social_media){
                return response()->json([
                    'status' => 'success',
                    'message' => 'social data found',
                    'data' => $social_media,
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }

    }


    /* Method for retrive specific social media information */

    public function retriveSpecificSocialMediaInfo(){
        try{
            $social_media = SocialMedias::where('global_social_media', '=', 1)->get(['social_media_link', 'social_media_icon']); // Getting specific social media data

            if($social_media){
                return response()->json([
                    'status' => 'success',
                    'message' => 'social data found',
                    'data' => $social_media,
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }

    }


    /* Method for delete social media information */

    public function deleteSocialMediaInfo(Request $request){
        try{
            // Getting award id from input
            $socialMediaInfoId = $request->input('social_media_info_id');
            
            // Delete award data by id
            $socialMediaDelete = SocialMedias::findOrFail($socialMediaInfoId)->delete(); 

            if($socialMediaDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'social media deleted'
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }
}
