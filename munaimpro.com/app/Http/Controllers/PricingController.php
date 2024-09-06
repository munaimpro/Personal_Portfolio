<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Pricing;
use Illuminate\Http\Request;
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
}
