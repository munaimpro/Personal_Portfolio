<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Experience;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ExperienceController extends Controller
{
    /* Method for experience page load */
    
    public function adminExperiencePage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.experience', compact(['seoproperty', 'routeName']));
    }


    /* Method for add Experience information */

    public function addExperienceInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'experience_title' => 'required|string|max:50',
                'experience_institution' => 'required|string|max:100',
                'experience_starting_date' => 'required|date',
                'experience_ending_date' => '',
            ]);

            if($validatedData['experience_ending_date'] && $validatedData['experience_starting_date'] === $validatedData['experience_ending_date']){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Dates should not be same'
                ]);
            } elseif($validatedData['experience_ending_date'] && $validatedData['experience_ending_date'] < $validatedData['experience_starting_date']){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid ending date'
                ]);
            } else{
                $experience = Experience::create($validatedData);

                if($experience){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'New Experience added'
                    ]);
                } else{
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Something went wrong'
                    ]);
                }
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }


    /* Method for update Experience information */

    public function updateExperienceInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'experience_title' => 'required|string|max:50',
                'experience_institution' => 'required|string|max:100',
                'experience_starting_date' => 'required|date',
                'experience_ending_date' => '',
                'experience_info_id' => '',
            ]);
        
            $experience = Experience::findOrFail($validatedData['experience_info_id']);
            $experience->update($validatedData);

            if($experience){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Experience details updated'
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


    /* Method for retrive all experience information */

    public function retriveAllExperienceInfo(){
        try{
            $experience = Experience::get(['id', 'experience_title', 'experience_institution', 'experience_starting_date', 'experience_ending_date']); // Getting all experience data

            if($experience){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Experience data found',
                    'data' => $experience,
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


    /* Method for retrive Experience information by id */

    public function retriveExperienceInfoById(Request $request){
        try{
            $experienceInfoId = $request->input('experience_info_id'); // Primary key id from input
        
            $experience = Experience::findOrFail($experienceInfoId, ['id', 'experience_title', 'experience_institution', 'experience_starting_date', 'experience_ending_date']); // Getting Experience data by id

            if($experience){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Experience data found',
                    'data' => $experience,
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


    /* Method for delete Experience information */

    public function deleteExperienceInfo(Request $request){
        try{
            // Getting experience id from input
            $experienceInfoId = $request->input('experience_info_id');
            
            // Delete experience data by id
            $experienceDelete = Experience::findOrFail($experienceInfoId)->delete(); 

            if($experienceDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Experience information deleted'
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
