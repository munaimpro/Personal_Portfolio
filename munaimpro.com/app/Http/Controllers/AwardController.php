<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    /* Method for add award information */

    public function addAwardInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'award_type' => 'required|string|max:50',
                'award_title' => 'required|string|max:100',
                'award_date' => 'required|string',
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
            $awardInfoId = $request->input('award_info_id');
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'award_type' => 'required|string|max:50',
                'award_title' => 'required|string|max:100',
                'award_date' => 'required|string',
                'award_provider' => 'required|string|max:255',
                'award_for' => 'required|string|max:255',
            ]);
        
            $award = Award::findOrFail($awardInfoId);
            $award->update($validatedData);

            if($award){
                return response()->json([
                    'status' => 'success',
                    'message' => 'award updated'
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


    /* Method for retrive all award information */

    public function retriveAllAwardInfo(){
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


    /* Method for retrive award information by id */

    public function retriveAwardInfoById(Request $request){
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
                    'message' => 'award deleted'
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
