<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
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
            $serviceInfoId = $request->input('service_info_id');
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'service_icon' => 'required|string|max:255',
                'service_title' => 'required|string|max:100',
                'service_description' => 'required|string',
            ]);
        
            $service = Service::findOrFail($serviceInfoId);
            $service->update($validatedData);

            if($service){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service updated'
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
            $service = Service::get(); // Getting all service data

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
        
            $service = Service::findOrFail($serviceInfoId); // Getting Service data by id

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
