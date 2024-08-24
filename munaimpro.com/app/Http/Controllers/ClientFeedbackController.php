<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use App\Models\ClientFeedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ClientFeedbackController extends Controller
{
    /* Method for admin client feedback page load */
        
    public function adminClientFeedbackPage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.client_feedback', compact(['seoproperty', 'routeName']));
    }


    /* Method for add client feedback information */

    public function addClientFeedbackInfo(Request $request){
        try {
            // Input validation process for backend
            $validatedData = $request->validate([
                'client_first_name' => 'required|string|max:50',
                'client_last_name' => 'required|string|max:50',
                'client_designation' => 'required|string|max:100',
                'client_image' => 'required|image|mimes:jpg,png,jpeg',
                'client_feedback' => 'required|string',
                'portfolio_id' => 'required|integer',
            ]);

            if ($request->hasFile('client_image')){
                // Getting client image
                $clientImage = $request->file('client_image');
                
                // Generating unique name for client image
                $clientImageName = $clientImage->getClientOriginalName();
                $clientImageUniqueName = substr(md5(time()), 0, 5) . '-' . $clientImageName;

                // Merge client image into array
                $clientData = array_merge($validatedData, [
                    'client_image' => $clientImageUniqueName
                ]);

                // Add client feedback
                $clientFeedback = ClientFeedback::create($clientData);

                // Store client image into storage/profile_picture/client_images folder
                if ($clientFeedback){
                    $clientImage->storeAs('profile_picture/client_images', $clientImageUniqueName, 'public');
                }

                return response()->json([
                    'status' => 'success',
                    'message' => 'New feedback added'
                ]);
            }

            return response()->json([
                'status' => 'failed',
                'message' => 'Files are missing'
            ]);
                
        } catch (Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }    


    /* Method for retrive all client feedback information */

    public function retrieveAllClientFeedbackInfo(Request $request){
        try{
            // Getting all client feedback data with portfolio name
            $clientFeedback = ClientFeedback::with(['portfolio:id,project_title'])->get();

            if($clientFeedback){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Client feedback data found',
                    'data' => $clientFeedback,
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


    /* Method for retrive client feedback information by id */

    public function retrieveClientFeedbackInfoById(Request $request){
        try{
            // Primary key id from input
            $clientFeedbackInfoId = $request->input('clientfeedback_info_id');
            
            // Getting portfolio data by id with service id and name
            $clientFeedback = ClientFeedback::with(['portfolio:id,project_title'])->findOrFail($clientFeedbackInfoId);

            if($clientFeedback){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Client feedback data found',
                    'data' => $clientFeedback,
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


    /* Method for delete post information */

    public function deleteClientFeedbackInfo(Request $request){
        // Start transaction
        DB::beginTransaction();
    
        try{
            // Getting client feedback id from input
            $clientFeedbackInfoId = $request->input('clientfeedback_info_id');
    
            // Retrieve client feedback from the database
            $clientFeedback = ClientFeedback::findOrFail($clientFeedbackInfoId);
    
            // Retrieve and delete the client image
            $clientImage = $clientFeedback->client_image;

            if($clientImage && Storage::exists("public/profile_picture/client_images/" . $clientImage)){
                if (!Storage::delete("public/profile_picture/client_images/" . $clientImage)){
                    // Rollback the transaction
                    DB::rollBack();

                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Failed to delete client image'
                    ]);
                }
            }
    
            // Delete client feedback data by id
            if (!$clientFeedback->delete()){
                DB::rollBack();

                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to delete client feedback'
                ]);
            }

            // Commit the transaction
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Client feedback deleted'
            ]);
    
        } catch (Exception $e){
            // Rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }  


    /* Method for client feedback page load */

    public function clientFeedbackPage(Request $request, $token){
        // Getting portfolio id from cached token
        $portfolioInfoId = Cache::get($token);

        if (!$portfolioInfoId) {
            return abort(404, 'This feedback link has expired or is invalid.');
        }
    
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.client_feedback', compact(['seoproperty', 'routeName']));
    }
}
