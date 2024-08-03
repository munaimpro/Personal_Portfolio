<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Education;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EducationController extends Controller
{
    /* Method for signup page load */
    
    public function adminEducationPage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.education', compact(['seoproperty', 'routeName']));
    }


    /* Method for add education information */

    public function addEducationInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'education_type' => 'required|string|max:100',
                'education_starting_date' => 'required|date',
                'education_ending_date' => 'required|date',
                'education_degree' => 'required|string|max:100',
                'education_institution' => 'required|string|max:100',
            ]);

            if($validatedData['education_starting_date'] === $validatedData['education_ending_date']){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Dates should not be same'
                ]);
            } elseif($validatedData['education_ending_date'] < $validatedData['education_starting_date']){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid ending date'
                ]);
            } else{
                $education = Education::create($validatedData);

                if($education){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Education information added'
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


    /* Method for update education information */

    public function updateEducationInfo(Request $request){
        try{
            $educationInfoId = $request->input('education_info_id');
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'education_type' => 'required|string|max:100',
                'education_starting_date' => 'required|date',
                'education_ending_date' => 'required|date',
                'education_degree' => 'required|string|max:100',
                'education_institution' => 'required|string|max:100',
            ]);

            if($validatedData['education_starting_date'] === $validatedData['education_ending_date']){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Dates should not be same'
                ]);
            } elseif($validatedData['education_ending_date'] < $validatedData['education_starting_date']){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid ending date'
                ]);
            } else{
        
                $education = Education::findOrFail($educationInfoId);
                $education->update($validatedData);

                if($education){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Education information updated'
                    ]);
                } else{
                    return response()->json([
                        'status' => 'filed',
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


    /* Method for retrive all education information */

    public function retriveAllEducationInfo(){
        try{
            $education = Education::get(); // Getting all education data

            if($education){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Education data found',
                    'data' => $education,
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


    /* Method for retrive education information by id */

    public function retriveEducationInfoById(Request $request){
        try{
            $educationInfoId = $request->input('education_info_id'); // Primary key id from input
        
            $education = Education::findOrFail($educationInfoId); // Getting education data by id
            
            if($education){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Education data found',
                    'data' => $education,
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


    /* Method for delete education information */

    public function deleteEducationInfo(Request $request){
        try{
            // Getting education id from input
            $educationInfoId = $request->input('education_info_id');
            
            // Delete education data by id
            $educationDelete = Education::findOrFail($educationInfoId)->delete(); 

            if($educationDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Education information deleted'
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
