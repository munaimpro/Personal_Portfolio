<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pricing;
use App\Models\Seoproperty;
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


    /* Method for add pricing information */

    public function addPricingInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'pricing_title' => 'required|string|max:50',
                'pricing_price' => 'required|numeric',
                'pricing_features' => 'required|array',
                'pricing_status' => ['nullable', Rule::in(['inactive', 'active'])],
            ]);
    
            // Converting the array of pricing features to JSON
            $validatedData['pricing_features'] = json_encode($validatedData['pricing_features']);
    
            // Creating new pricing record
            $pricing = Pricing::create($validatedData);
    
            if($pricing){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pricing details updated'
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to create new pricing'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: '.$e->getMessage()
            ]);
        }
    }


    /* Method for retrieve all pricing information */

    public function retrieveAllPricingInfo(Request $request){
        try{
            $pricing = Pricing::get(['id', 'pricing_title', 'pricing_price', 'pricing_features', 'pricing_status']); // Getting all pricing data

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
        
            $pricing = Pricing::findOrFail($pricingInfoId, ['id', 'pricing_title', 'pricing_price', 'pricing_features', 'pricing_status']); // Getting pricing data by id

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
                'pricing_price' => 'required|numeric',
                'pricing_features' => 'required|array',
                'pricing_status' => ['nullable', Rule::in(['inactive', 'active'])],
                'pricing_info_id' => 'required|exists:pricings,id',
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


    /* Method for delete pricing information */

    public function deletePricingInfo(Request $request){
        try{
            // Getting pricing id from input
            $pricingInfoId = $request->input('pricing_info_id');
            
            // Delete pricing data by id
            $pricingDelete = Pricing::findOrFail($pricingInfoId)->delete(); 

            if($pricingDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pricing information deleted'
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


    /* Method for website pricing page load */
    
    public function websitePricingPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));
        
        // Getting SEO property
        $seoproperty = Seoproperty::where('page_name', 'index')->first();

        // Checking data availability before loading page
        if(!Pricing::exists()){
            abort(404, 'Page not available');
        }

        return view('website.pages.pricing', compact(['routeName', 'seoproperty']));
    }
    
}
