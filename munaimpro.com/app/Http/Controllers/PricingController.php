<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class PricingController extends Controller
{
    /* Method for admin skill page load */
    
    public function adminPricingPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.pricing', compact(['routeName']));
    }


    /* Method for retrieve all pricing information */

    public function retrieveAllPricingInfo(Request $request){
        try{
            $pricing = Pricing::get(['id', 'pricing_title', 'pricing_price', 'pricing_status']); // Getting all pricing data

            if($pricing){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pricing data found',
                    'data' => $pricing,
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


    /* Method for retrieve pricing information by id */

    public function retrievepricingInfoById(Request $request){
        try{
            $pricingInfoId = $request->input('pricing_info_id'); // Primary key id from input
        
            $pricing = Pricing::findOrFail($pricingInfoId, ['id', 'pricing_title', 'pricing_price', 'pricing_features']); // Getting pricing data by id

            if($pricing){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pricing data found',
                    'data' => $pricing,
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


    /* Method for update pricing information */

    public function updatePricingInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'pricing_title' => 'required|string|max:50',
                'pricing_price' => 'required|numeric', // Corrected to numeric
                'pricing_features' => 'required|array', // Validate features as an array
                'pricing_info_id' => 'required|exists:pricings,id', // Validate the ID
            ]);
    
            // Converting the array of pricing features to JSON
            $validatedData['pricing_features'] = json_encode($validatedData['pricing_features']);
    
            // Find the pricing record and update
            $pricing = Pricing::findOrFail($validatedData['pricing_info_id']);
            $pricing->update($validatedData);
    
            if($pricing){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pricing details updated'
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to update pricing details'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: '.$e->getMessage()
            ]);
        }
    }
    
}
