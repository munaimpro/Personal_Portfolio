<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Award;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AwardController extends Controller
{
    /* Method for admin award page load */
    
    public function adminAwardPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.award', compact(['routeName']));
    }


    /* Method for add award information */

    public function addAwardInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'award_type' => 'required|string|max:50',
                'award_title' => 'required|string|max:100',
                'award_date' => 'required|date',
                'award_provider' => 'required|string|max:255',
                'award_for' => 'required|string|max:255',
            ]);

            $award = Award::create($validatedData);

            if($award){
                return response()->json([
                    'status' => 'success',
                    'message' => 'New award added'
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


    /* Method for update award information */

    public function updateAwardInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'award_type' => 'required|string|max:50',
                'award_title' => 'required|string|max:100',
                'award_date' => 'required|string',
                'award_provider' => 'required|string|max:255',
                'award_for' => 'required|string|max:255',
                'award_info_id' => '',
            ]);
        
            $award = Award::findOrFail($validatedData['award_info_id']);
            $award->update($validatedData);

            if($award){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Award information updated'
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


    /* Method for retrieve all award information */

    public function retrieveAllAwardInfo(){
        try{
            $award = Award::get(['id', 'award_type', 'award_title', 'award_date', 'award_provider', 'award_for']); // Getting all award data

            if($award){
                return response()->json([
                    'status' => 'success',
                    'message' => 'award data found',
                    'data' => $award,
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


    /* Method for retrieve award information by id */

    public function retrieveAwardInfoById(Request $request){
        try{
            $awardInfoId = $request->input('award_info_id'); // Primary key id from input
        
            $award = Award::findOrFail($awardInfoId, ['id', 'award_type', 'award_title', 'award_date', 'award_provider', 'award_for']); // Getting award data by id

            if($award){
                return response()->json([
                    'status' => 'success',
                    'message' => 'award data found',
                    'data' => $award,
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


    /* Method for delete award information */

    public function deleteAwardInfo(Request $request){
        try{
            // Getting award id from input
            $awardInfoId = $request->input('award_info_id');
            
            // Delete award data by id
            $awardDelete = Award::findOrFail($awardInfoId)->delete(); 

            if($awardDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Award deleted'
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
