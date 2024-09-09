<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Portfolio;
use App\Models\Seoproperty;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /* Method for admin portfolio page load */
        
    public function adminPortfolioPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.portfolio', compact(['routeName']));
    }


    /* Method for add portfolio information */

    public function addPortfolioInfo(Request $request){
        try {
            // Input validation process for backend
            $validatedData = $request->validate([
                'project_title' => 'required|string|max:255',
                'project_thumbnail' => 'required|image',
                'project_ui_image.*' => 'required|image', // Allow multiple images
                'project_type' => 'required|string|max:100',
                'service_id' => 'required|integer',
                'project_description' => 'required|string',
                'project_starting_date' => 'required|date',
                'project_ending_date' => '',
                'project_url' => 'required|string|max:100',
                'core_technology' => 'required|string|max:100',
                'project_status' => 'required|string',
            ]);

            if($validatedData['project_ending_date'] && $validatedData['project_ending_date'] < $validatedData['project_starting_date']){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid ending date'
                ]);
            } else{
                if ($request->hasFile('project_thumbnail') && $request->hasFile('project_ui_image')){
                    // Getting thumbnail file
                    $portfolioThumbnail = $request->file('project_thumbnail');
                    
                    // Generating unique name for thumbnail
                    $portfolioThumbnailName = $portfolioThumbnail->getClientOriginalName();
                    $portfolioThumbnailUniqueName = substr(md5(time()), 0, 5) . '-' . $portfolioThumbnailName;

                    // Getting UI images
                    $uiImages = $request->file('project_ui_image');
                    $uiImageNames = [];

                    // Generating unique name for UI images
                    foreach($uiImages as $uiImage){
                        $uiImageName = substr(md5(time()), 0, 5) . '-' . $uiImage->getClientOriginalName();
                        $uiImage->storeAs('portfolio/ui_images', $uiImageName, 'public');
                        $uiImageNames[] = $uiImageName;
                    }

                    // Convert the array of image names to JSON
                    $uiJsonImage = json_encode($uiImageNames);

                    // Merge thumbnail image and UI images into array
                    $portfolioData = array_merge($validatedData, [
                        'project_thumbnail' => $portfolioThumbnailUniqueName,
                        'project_ui_image' => $uiJsonImage
                    ]);

                    // Create portfolio
                    $portfolio = Portfolio::create($portfolioData);

                    // Store portfolio thumbnail into storage/public/portfolio/thumbnails folder
                    if ($portfolio){
                        $portfolioThumbnail->storeAs('portfolio/thumbnails', $portfolioThumbnailUniqueName, 'public');
                    }

                    return response()->json([
                        'status' => 'success',
                        'message' => 'New portfolio added'
                    ]);
                }

                return response()->json([
                    'status' => 'failed',
                    'message' => 'Files are missing'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }


    /* Method for update portfolio information */

    public function updatePortfolioInfo(Request $request){
        try {
            // Start DB transaction
            DB::beginTransaction();

            // Input validation process for backend
            $validatedData = $request->validate([
                'project_title' => 'required|string|max:255',
                'project_type' => 'required|string|max:100',
                'service_id' => 'required|integer',
                'project_description' => 'required|string',
                'project_starting_date' => 'required|date',
                'project_ending_date' => 'nullable|date',
                'project_url' => 'required|string|max:100',
                'core_technology' => 'required|string|max:100',
                'project_status' => 'required|string',
                'portfolio_info_id' => 'required|integer|exists:portfolios,id',
            ]);
    
            // Retrieve portfolio instance only once
            $portfolio = Portfolio::findOrFail($validatedData['portfolio_info_id']);
    
            // Handle project thumbnail
            if ($request->hasFile('project_thumbnail')) {
                // Validate thumbnail
                $request->validate(['project_thumbnail' => 'image']);
    
                // Remove previous thumbnail from storage
                if ($portfolio->project_thumbnail && Storage::exists("public/portfolio/thumbnails/".$portfolio->project_thumbnail)) {
                    Storage::delete("public/portfolio/thumbnails/".$portfolio->project_thumbnail);
                }
    
                // Store new thumbnail
                $projectThumbnail = $request->file('project_thumbnail');
                $projectThumbnailName = substr(md5(time()), 0, 5) . '-' . $projectThumbnail->getClientOriginalName();
                $projectThumbnail->storeAs('portfolio/thumbnails', $projectThumbnailName, 'public');
                $validatedData['project_thumbnail'] = $projectThumbnailName;
            }
    
            // Handle UI images
            if ($request->hasFile('project_ui_image')) {
                // Validate UI images
                $request->validate(['project_ui_image.*' => 'image']);
    
                $projectUiImages = $request->file('project_ui_image');
    
                // Convert existing UI images JSON to array, or initialize an empty array
                $existingUiImages = json_decode($portfolio->project_ui_image, true) ?: [];
    
                // Add new UI images to array
                foreach ($projectUiImages as $uiImage) {
                    $uiImageName = substr(md5(time()), 0, 5) . '-' . $uiImage->getClientOriginalName();
                    $uiImage->storeAs('portfolio/ui_images', $uiImageName, 'public');
                    $existingUiImages[] = $uiImageName;
                }
    
                // Convert back to JSON and update validated data
                $validatedData['project_ui_image'] = json_encode($existingUiImages);
            }
    
            // Update portfolio with validated data
            $portfolio->update($validatedData);

            // Commit the transaction
            DB::commit();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Portfolio details updated'
            ]);
    
        } catch(Exception $e){
            // Rollback the transaction
            DB::rollBack();

            // Catch and handle exceptions
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }    


    /* Method for retrieve all post information */

    public function retrieveAllPortfolioInfo(Request $request){
        try{
            // Getting all portfolio data with category and user
            $portfolio = Portfolio::with(['service:id,service_title'])->get();

            if($portfolio){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Portfolio data found',
                    'data' => $portfolio,
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


    /* Method for retrieve post information by id */

    public function retrievePortfolioInfoById(Request $request){
        try{
            // Primary key id from input
            $portfolioInfoId = $request->input('portfolio_info_id');
            
            // Getting portfolio data by id with service id and name
            $portfolio = Portfolio::with([
                'service:id,service_title',
                'client_feedback:id,client_first_name,client_last_name,client_image,client_feedback,client_designation,portfolio_id,created_at'
            ])->findOrFail($portfolioInfoId);

            if($portfolio){
                // Increasing portfolio view on details view
                $portfolio->increment('project_view');

                return response()->json([
                    'status' => 'success',
                    'message' => 'Portfolio data found',
                    'data' => $portfolio,
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


    /* Method for removing a UI image from a portfolio */

    public function removePortfolioUiImage(Request $request){
        try {
            // Getting portfolio id & image name from input
            $portfolioInfoId = $request->input('portfolio_info_id');
            $uiImageName = $request->input('ui_image_name');
    
            // Retrieve the portfolio
            $portfolio = Portfolio::findOrFail($portfolioInfoId);
    
            // Decode the JSON object
            $uiImages = json_decode($portfolio->project_ui_image, true);
    
            if(count($uiImages) > 1){
                // Remove the image from the array
                $updatedImages = array_filter($uiImages, function($image) use ($uiImageName){
                    return $image !== $uiImageName;
                });
    
                // Encode the array to JSON after re-indexing
                $portfolio->project_ui_image = json_encode(array_values($updatedImages));
    
                // Remove the image from storage
                if (Storage::exists("public/portfolio/ui_images/" . $uiImageName)) {
                    Storage::delete("public/portfolio/ui_images/" . $uiImageName);
                }
    
                // Save the updated portfolio
                $portfolioSave = $portfolio->save();
    
                if ($portfolioSave) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'UI image removed successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Failed to update portfolio'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Minimum 1 UI image required'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }  


    /* Method for delete portfolio information */

    public function deletePortfolioInfo(Request $request){
        // Start transaction
        DB::beginTransaction();
    
        try{
            // Getting portfolio id from input
            $portfolioInfoId = $request->input('portfolio_info_id');
    
            // Retrieve portfolio from the database
            $portfolio = Portfolio::findOrFail($portfolioInfoId);
    
            // Retrieve and delete the portfolio thumbnail
            $portfolioThumbnail = $portfolio->project_thumbnail;

            if($portfolioThumbnail && Storage::exists("public/portfolio/thumbnails/" . $portfolioThumbnail)){
                if (!Storage::delete("public/portfolio/thumbnails/" . $portfolioThumbnail)){
                    // Rollback the transaction
                    DB::rollBack();

                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Failed to delete portfolio thumbnail'
                    ]);
                }
            }
    
            // Retrieve and delete all UI images
            $uiImages = json_decode($portfolio->project_ui_image, true);

            if (!empty($uiImages)){
                foreach($uiImages as $uiImage){
                    if (Storage::exists("public/portfolio/ui_images/" . $uiImage)){
                        if (!Storage::delete("public/portfolio/ui_images/" . $uiImage)){
                            // Rollback the transaction
                            DB::rollBack();

                            return response()->json([
                                'status' => 'failed',
                                'message' => 'Failed to delete UI images'
                            ]);
                        }
                    }
                }
            }
    
            // Delete portfolio data by id
            if (!$portfolio->delete()){
                DB::rollBack();

                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to delete portfolio'
                ]);
            }

            // Commit the transaction
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Portfolio deleted'
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


    /* Method for generate feedback URL */
    
    public function generateFeedbackUrl(Request $request){
        // Primary key id from input
        $portfolioInfoId = $request->input('portfolio_info_id');

        // Generating random token
        $token = Str::random(40);

        // Expire date generation
        $expiresAt = Carbon::now()->addMinutes(5);

        // Putting information to cache
        $cache = Cache::put($token, $portfolioInfoId, $expiresAt);

        if($cache){
            return response()->json([
                'status' => 'success',
                'message' => 'Feedback URL generated',
                'cache' => $token,
            ]);
        } else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong',
            ]);
        }
    }


    /* Method for website portfolio page load */
    
    public function websitePortfolioPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        // Checking data availability before loading page
        if(!Portfolio::exists()){
            abort(404, 'Page not available');
        }
        
        // Getting SEO property
        $seoproperty = Seoproperty::where('page_name', 'portfolio')->first();

        return view('website.pages.portfolio', compact(['routeName', 'seoproperty']));
    }


    /* Method for website portfolio details page load */
    
    public function websitePortfolioDetailsPage($id){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));
        
        // Getting SEO property
        $seoproperty = Seoproperty::where('page_name', 'portfolio_details')->first();

        // Checking data availability before loading page
        if(!is_numeric($id) || !Portfolio::where('id', $id)->exists()){
            abort(404, 'No project available');
        }

        return view('website.pages.portfolio_details', compact(['routeName', 'seoproperty', 'id']));
    }
}
