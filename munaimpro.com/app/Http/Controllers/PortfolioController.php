<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Portfolio;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /* Method for admin portfolio page load */
        
    public function adminPortfolioPage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.portfolio', compact(['seoproperty', 'routeName']));
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
                'client_name' => 'required|string|max:100',
                'client_designation' => 'nullable|string|max:100',
                'project_starting_date' => 'required|date',
                'project_ending_date' => 'required|date',
                'project_url' => 'required|string|max:100',
                'core_technology' => 'required|string|max:100',
                'project_status' => 'required|string',
            ]);

            if ($request->hasFile('project_thumbnail') && $request->hasFile('project_ui_image')) {
                // Getting thumbnail file
                $portfolioThumbnail = $request->file('project_thumbnail');
                
                // Generate unique name for thumbnail
                $portfolioThumbnailName = $portfolioThumbnail->getClientOriginalName();
                $portfolioThumbnailUniqueName = substr(md5(time()), 0, 5) . '-' . $portfolioThumbnailName;

                // Getting UI images
                $uiImages = $request->file('project_ui_image');
                $uiImageNames = [];

                foreach($uiImages as $uiImage){
                    $uiImageName = substr(md5(time()), 0, 5) . '-' . $uiImage->getClientOriginalName();
                    $uiImage->storeAs('portfolio/ui_images', $uiImageName, 'public');
                    $uiImageNames[] = $uiImageName;
                }

                // Convert the array of image names to JSON
                $uiJsonImage = json_encode($uiImageNames);

                dd($uiJsonImage);

                // Merge thumbnail image and UI images into array
                $portfolioData = array_merge($validatedData, [
                    'project_thumbnail' => $portfolioThumbnailUniqueName,
                    'project_ui_image' => $uiJsonImage
                ]);

                // Create portfolio
                $portfolio = Portfolio::create($portfolioData);

                // Store portfolio thumbnail into storage/public/post_thumbnails folder
                if ($portfolio) {
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
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }


    /* Method for update portfolio information */

    public function updatePortfolioInfo(Request $request){
        try{
            $portfolioInfoId = $request->input('portfolio_info_id');
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'project_title' => 'required|string|max:255',
                'project_thumbnail' => 'image',
                'project_ui_image.*' => 'image', // Allow multiple images
                'project_type' => 'required|string|max:100',
                'service_id' => 'required|integer',
                'project_description' => 'required|string',
                'client_name' => 'required|string|max:100',
                'client_designation' => 'nullable|string|max:100',
                'project_starting_date' => 'required|string',
                'project_ending_date' => 'required|string',
                'project_url' => 'required|string|max:100',
                'core_technology' => 'required|string|max:100',
                'project_status' => 'required|string',
            ]);

            // Matching both user id for validated post owner
            

                if($request->hasFile('project_thumbnail')){
                    // Retrive project thumbnail link from database
                    $getPreviousProjectThumbnail = Portfolio::where('id', '=', $portfolioInfoId)->first('project_thumbnail');

                    // Remove previous portfolio thumbnail file from storage
                    if($getPreviousProjectThumbnail){
                        if(Storage::exists("public/portfolio/thumbnails/".$getPreviousProjectThumbnail->project_thumbnail)){
                            Storage::delete("public/portfolio/thumbnails/".$getPreviousProjectThumbnail->project_thumbnail);
                        }
                    }

                    // Getting new project thumbnail file
                    $projectThumbnail = $request->file('project_thumbnail');

                    /* Extract the original file name with extension */
                    $projectThumbnailName = $projectThumbnail->getClientOriginalName();
                    $projectThumbnailUniqueName = substr(md5(time()), 0, 5).'-'.$projectThumbnail;
    
                    /* Merge thumbnail image into array */
                    $portfolioData = array_merge($validatedData, ['project_thumbnail' => $projectThumbnailUniqueName]);
    
                    $portfolio = Portfolio::findOrFail($portfolioInfoId)->update($portfolioData);
    
                    /* Store project thumbnail into storage/public/project/thumbnails folder */
                    if ($portfolio){
                        $projectThumbnail->storeAs('post_thumbnails', $projectThumbnailUniqueName, 'public');
                    }
                } else{
                    Portfolio::findOrFail($portfolioInfoId)->update($validatedData);
                }
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'portfolio updated'
                ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }


    /* Method for retrive all post information */

    public function retriveAllPortfolioInfo(Request $request){
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


    /* Method for retrive post information by id */

    public function retrivePortfolioInfoById(Request $request){
        try{
            $portfolioInfoId = $request->input('portfolio_info_id'); // Primary key id from input
            
            // Getting post data by id with category and user
            $post = Portfolio::with(['category:id,category_name', 'user:id'])->findOrFail($portfolioInfoId);

            if($post){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Post data found',
                    'data' => $post,
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

    public function deletePortfolioInfo(Request $request){
        try{
            // Getting post id from input
            $portfolioInfoId = $request->input('portfolio_info_id');

            // Retrive post thumbnail link from database
            $getPreviousPortfolioThumbnail = Portfolio::where('id', '=', $portfolioInfoId)->first('post_thumbnail');

            // Remove previous post thumbnail file from storage
            if($getPreviousPortfolioThumbnail){
                if(Storage::exists("public/portfolio/thumbnails".$getPreviousPortfolioThumbnail->portfolio_thumbnail)){
                    $deleteThumbnail = Storage::delete("public/portfolio/thumbnails".$getPreviousPortfolioThumbnail->portfolio_thumbnail);

                    if($deleteThumbnail){
                        // Delete post data by id
                        $portfolioDelete = Portfolio::findOrFail($portfolioInfoId)->delete();

                        if($portfolioDelete){
                            return response()->json([
                                'status' => 'success',
                                'message' => 'Portfolio deleted'
                            ]);
                        } else{
                            return response()->json([
                                'status' => 'failed',
                                'message' => 'Something went wrong'
                            ]);
                        }
                    } else{
                        return response()->json([
                            'status' => 'failed',
                            'message' => 'Something went wrong'
                        ]);
                    }
                }
            } else{
                // Delete portfolio data by id
                $postDelete = Portfolio::findOrFail($portfolioInfoId)->delete();

                if($postDelete){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Post deleted'
                    ]);
                } else{
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Something went wrong'
                    ]);
                }
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }


    /* Method for retrive post information by slug */

    public function retrivePostInfoBySlug($slug){
        try{
            // Getting post data by slug with category and user
            $post = Portfolio::where('post_slug', '=', $slug)->with(['category:id,category_name', 'user:id,first_name,last_name'])->get(['id', 'post_heading', 'post_slug', 'post_thumbnail', 'post_description', 'category_id', 'user_id']);

            if($post){
                // Increasing post view on details view
                Portfolio::where('post_slug', '=', $slug)->increment('post_view');

                return response()->json([
                    'status' => 'success',
                    'message' => 'Post data found',
                    'data' => $post,
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


    /* Method for retrive previous post information by id */

    public function retrivePreviousPostInfoById(Request $request){
        try{
            $portfolioInfoId = $request->input('portfolio_info_id'); // Primary key id from input
            
            // Get previous id
            $previousPostInfoId = Portfolio::where('id', '<', $portfolioInfoId)->pluck('id');
            
            // Getting post data by id with category and user
            $post = Portfolio::with(['category:id,category_name', 'user:id'])->findOrFail($previousPostInfoId, ['id', 'post_heading', 'post_thumbnail', 'publish_time']);

            if($post){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Previous post data found',
                    'data' => $post,
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


    /* Method for retrive next post information by id */

    public function retriveNextPostInfoById(Request $request){
        try{
            $portfolioInfoId = $request->input('portfolio_info_id'); // Primary key id from input
            
            // Get previous id
            $previousPostInfoId = Portfolio::where('id', '>', $portfolioInfoId)->pluck('id');
            
            // Getting post data by id with category and user
            $post = Portfolio::with(['category:id,category_name', 'user:id'])->findOrFail($previousPostInfoId, ['id', 'post_heading', 'post_thumbnail', 'publish_time']);

            if($post){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Next post data found',
                    'data' => $post,
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


    /* Method for retrive latest post information by id */

    public function retriveLatestPostInfo(){
        try{
            // Getting latest 2 post data with category and user
            $post = Portfolio::with(['category:id,category_name', 'user:id'])->latest('publish_time')->take(2)->get(['id', 'post_heading', 'post_thumbnail', 'publish_time']);

            if($post){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Latest post data found',
                    'data' => $post,
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
