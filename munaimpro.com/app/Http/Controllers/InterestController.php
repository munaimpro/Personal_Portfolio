<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Interest;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class InterestController extends Controller
{
    /* Method for admin interest page load */
    
    public function adminInterestPage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.interest', compact(['seoproperty', 'routeName']));
    }


    /* Method for add interest information */

    public function addInterestInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'interest_title' => 'required|string|max:100',
                'interest_icon' => 'required|string|max:50',
            ]);

            $interest = Interest::create($validatedData);

            if($interest){
                return response()->json([
                    'status' => 'success',
                    'message' => 'New interest item added'
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


    /* Method for update interest information */

    public function updateInterestInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'interest_title' => 'required|string|max:100',
                'interest_icon' => 'required|string|max:50',
                'interest_info_id' => '',
            ]);
        
            $interest = Interest::findOrFail($validatedData['interest_info_id']);
            $interest->update($validatedData);

            if($interest){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Interest details updated'
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


    /* Method for retrive all interest information */

    public function retriveAllInterestInfo(Request $request){
        try{
            $interest = Interest::get(['id', 'interest_title', 'interest_icon']); // Getting all interest data

            if($interest){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Interest data found',
                    'data' => $interest,
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


    /* Method for retrive interest information by id */

    public function retriveInterestInfoById(Request $request){
        try{
            $interestInfoId = $request->input('interest_info_id'); // Primary key id from input
        
            $interest = Interest::findOrFail($interestInfoId, ['id', 'interest_title', 'interest_icon']); // Getting interest data by id

            if($interest){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Interest data found',
                    'data' => $interest,
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


    /* Method for delete interest information */

    public function deleteInterestInfo(Request $request){
        try{
            // Getting interest id from input
            $interestInfoId = $request->input('interest_info_id');
            
            // Delete interest data by id
            $interestDelete = Interest::findOrFail($interestInfoId)->delete(); 

            if($interestDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Interest information deleted'
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
