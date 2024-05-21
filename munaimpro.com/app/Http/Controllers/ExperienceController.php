<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /* Method for add Experience information */

    public function addExperienceInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'experience_title' => 'required|string|max:50',
                'experience_institution' => 'required|string|max:100',
                'experience_starting_date' => 'required|date',
                'experience_ending_date' => 'required|date',
            ]);

            $experience = Experience::create($validatedData);

            if($experience){
                return response()->json([
                    'status' => 'success',
                    'message' => 'New Experience added'
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


    /* Method for update Experience information */

    public function updateExperienceInfo(Request $request){
        try{
            $experienceInfoId = $request->input('experience_info_id');
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'experience_title' => 'required|string|max:50',
                'experience_institution' => 'required|string|max:100',
                'experience_starting_date' => 'required|date',
                'experience_ending_date' => 'required|date',
            ]);
        
            $experience = Experience::findOrFail($experienceInfoId);
            $experience->update($validatedData);

            if($experience){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Experience updated'
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

    public function retriveAllExperienceInfo(Request $request){
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
            // Getting Experience id from input
            $experienceInfoId = $request->input('experience_info_id');
            
            // Delete Experience data by id
            $experienceDelete = Experience::findOrFail($experienceInfoId)->delete(); 

            if($experienceDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Experience deleted'
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
