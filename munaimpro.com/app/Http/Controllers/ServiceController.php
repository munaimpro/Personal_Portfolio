<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Service;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ServiceController extends Controller
{
    /* Method for admin skill page load */
    
    public function adminServicePage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.services', compact(['routeName']));
    }


    /* Method for add service information */

    public function addServiceInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'service_icon' => 'required|string|max:255',
                'service_title' => 'required|string|max:100',
                'service_description' => 'required|string',
            ]);

            $service = Service::create($validatedData);

            if($service){
                return response()->json([
                    'status' => 'success',
                    'message' => 'New Service added'
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


    /* Method for update service information */

    public function updateServiceInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'service_icon' => 'required|string|max:255',
                'service_title' => 'required|string|max:100',
                'service_description' => 'required|string',
                'service_status' => 'required',
                'service_info_id' => '',
            ]);
        
            $service = Service::findOrFail($validatedData['service_info_id']);
            $service->update($validatedData);

            if($service){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service details updated'
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


    /* Method for retrive all service information */

    public function retriveAllServiceInfo(Request $request){
        try{
            $service = Service::get(['id', 'service_icon', 'service_title', 'service_description', 'service_status']); // Getting all service data

            if($service){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service data found',
                    'data' => $service,
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


    /* Method for retrive service information by id */

    public function retriveServiceInfoById(Request $request){
        try{
            $serviceInfoId = $request->input('service_info_id'); // Primary key id from input
        
            $service = Service::findOrFail($serviceInfoId, ['id', 'service_icon', 'service_title', 'service_description']); // Getting Service data by id

            if($service){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service data found',
                    'data' => $service,
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


    /* Method for delete service information */

    public function deleteServiceInfo(Request $request){
        try{
            // Getting Service id from input
            $serviceInfoId = $request->input('service_info_id');
            
            // Delete Service data by id
            $serviceDelete = Service::findOrFail($serviceInfoId)->delete(); 

            if($serviceDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service deleted'
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
