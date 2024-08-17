<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /* Method for admin skill page load */
        
    public function adminPostPage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.post', compact(['seoproperty', 'routeName']));
    }
    
    
    /* Method for add post information */

    public function addPostInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'post_heading' => 'required|string|max:255',
                'post_slug' => 'required|string|max:255',
                'post_thumbnail' => 'required|image|mimes:jpeg,jpg,png|max:2048',
                'post_description' => 'required|string',
                'category_id' => 'required|integer',
                'publish_time' => 'string',
                'post_status' => 'string',
            ]);

            // User ID from header
            $userId = $request->header('userId');

            if($request->hasFile('post_thumbnail')){
                /* Getting file */
                $postThumbnail = $request->file('post_thumbnail');

                /* Extract the original file name with extension */
                $postThumbnailName = $postThumbnail->getClientOriginalName();
                $postThumbnailUniqueName = substr(md5(time()), 0, 5).'-'.$postThumbnailName;

                /* Merge thumbnail image into array */
                $postData = array_merge($validatedData, ['post_thumbnail' => $postThumbnailUniqueName, 'user_id' => $userId]);

                /* Merge publish time into array */
                if($request->input('publish_time')){
                    $postData = array_merge($validatedData, ['post_thumbnail' => $postThumbnailUniqueName, 'publish_time' => $request->input('publish_time'), 'user_id' => $userId]);
                }

                /* Merge publish time and post status into array */
                if($request->input('publish_time') && $request->input('post_status')){
                    $postData = array_merge($validatedData, ['post_thumbnail' => $postThumbnailUniqueName, 'publish_time' => $request->input('publish_time'), 'post_status' => $request->input('post_status'), 'user_id' => $userId]);
                }

                $post = Post::create($postData);

                /* Store post thumbnail into storage/public/post_thumbnails folder */
                if ($post){
                    $postThumbnail->storeAs('post_thumbnails', $postThumbnailUniqueName, 'public');
                }
            }

            if($post){
                return response()->json([
                    'status' => 'success',
                    'message' => 'New blog created'
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
    
    
    /* Method for publish schedule post */

    public function publishSchedulePost(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'current_time' => 'required',
            ]);

            // Getting the current time
            $currentTime = Carbon::parse($validatedData['current_time'])->setTimezone('Asia/Dhaka')->format('Y-m-d H:i:s');

            // Update the status of posts that are scheduled to be published at the current time
            $publishedPost = Post::where('publish_time', '=', $currentTime)->where('post_status', 'scheduled')->update(['post_status' => 'published']);

            if($publishedPost){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Scheduled posts have been published successfully'
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


    /* Method for update post information */

    public function updatePostInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'post_heading' => 'required|string|max:255',
                'post_slug' => 'required|string|max:255',
                'post_thumbnail' => $request->hasFile('post_thumbnail') ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
                'post_description' => 'required|string',
                'category_id' => 'required|integer',
                'user_id' => 'required|integer',
                'publish_time' => 'string',
                'post_status' => 'required|string',
                'post_info_id' => 'required|integer',
            ]);

            // User ID from header
            $userIdFromHeader = (int) $request->header('userId');

            // User ID from input
            $userIdFromInput = $request->input('user_id');

            // Matching both user id for validated post owner
            if($userIdFromHeader === $userIdFromInput){

                if($request->hasFile('post_thumbnail')){
                    // Retrive post thumbnail link from database
                    $getPreviousPostThumbnail = Post::where('id', '=', $validatedData['post_info_id'])->first('post_thumbnail');

                    // Remove previous post thumbnail file from storage
                    if($getPreviousPostThumbnail){
                        if(Storage::exists("public/post_thumbnails/".$getPreviousPostThumbnail->post_thumbnail)){
                            Storage::delete("public/post_thumbnails/".$getPreviousPostThumbnail->post_thumbnail);
                        }
                    }

                    // Getting new post thumbnail file
                    $postThumbnail = $request->file('post_thumbnail');

                    /* Extract the original file name with extension */
                    $postThumbnailName = $postThumbnail->getClientOriginalName();
                    $postThumbnailUniqueName = substr(md5(time()), 0, 5).'-'.$postThumbnailName;
    
                    /* Merge thumbnail image into array */
                    $postData = array_merge($validatedData, ['post_thumbnail' => $postThumbnailUniqueName]);
    
                    $post = Post::findOrFail($validatedData['post_info_id'])->update($postData);
    
                    /* Store post thumbnail into storage/public/post_thumbnails folder */
                    if ($post){
                        $postThumbnail->storeAs('post_thumbnails', $postThumbnailUniqueName, 'public');

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Post updated'
                        ]);
                    } else{
                        return response()->json([
                            'status' => 'failed',
                            'message' => 'Something went wrong'
                        ]);
                    }
                } else{
                    $post = Post::findOrFail($validatedData['post_info_id'])->update($validatedData);

                    if($post){
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Post updated'
                        ]);
                    } else{
                        return response()->json([
                            'status' => 'failed',
                            'message' => 'Something went wrong'
                        ]);
                    }
                }

            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User not matched'
                ]);
            }

            
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }


    /* Method for retrive all post information */

    public function retriveAllPostInfo(Request $request){
        try{
            // Getting all post data with category and user
            $post = Post::with(['category:id,category_name', 'user:id,first_name,last_name'])->get();

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


    /* Method for retrive post information by id */

    public function retrivePostInfoById(Request $request){
        try{
            // Primary key id from input
            $postInfoId = $request->input('post_info_id');
            
            // Getting post data by id with category and user
            $post = Post::with(['category:id,category_name', 'user:id'])->findOrFail($postInfoId);

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

    public function deletePostInfo(Request $request){
        try{
            // Getting post id from input
            $postInfoId = $request->input('post_info_id');

            // Retrive post thumbnail link from database
            $getPreviousPostThumbnail = Post::where('id', '=', $postInfoId)->first('post_thumbnail');

            // Remove previous post thumbnail file from storage
            if($getPreviousPostThumbnail){
                if(Storage::exists("public/post_thumbnails/".$getPreviousPostThumbnail->post_thumbnail)){
                    $deleteThumbnail = Storage::delete("public/post_thumbnails/".$getPreviousPostThumbnail->post_thumbnail);

                    if($deleteThumbnail){
                        // Delete post data by id
                        $postDelete = Post::findOrFail($postInfoId)->delete();

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
                    } else{
                        return response()->json([
                            'status' => 'failed',
                            'message' => 'Something went wrong'
                        ]);
                    }
                }
            } else{
                // Delete post data by id
                $postDelete = Post::findOrFail($postInfoId)->delete();

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
            $post = Post::where('post_slug', '=', $slug)->with(['category:id,category_name', 'user:id,first_name,last_name'])->get(['id', 'post_heading', 'post_slug', 'post_thumbnail', 'post_description', 'category_id', 'user_id']);

            if($post){
                // Increasing post view on details view
                Post::where('post_slug', '=', $slug)->increment('post_view');

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
            $postInfoId = $request->input('post_info_id'); // Primary key id from input
            
            // Get previous id
            $previousPostInfoId = Post::where('id', '<', $postInfoId)->pluck('id');
            
            // Getting post data by id with category and user
            $post = Post::with(['category:id,category_name', 'user:id'])->findOrFail($previousPostInfoId, ['id', 'post_heading', 'post_thumbnail', 'publish_time']);

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
            $postInfoId = $request->input('post_info_id'); // Primary key id from input
            
            // Get previous id
            $previousPostInfoId = Post::where('id', '>', $postInfoId)->pluck('id');
            
            // Getting post data by id with category and user
            $post = Post::with(['category:id,category_name', 'user:id'])->findOrFail($previousPostInfoId, ['id', 'post_heading', 'post_thumbnail', 'publish_time']);

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
            $post = Post::with(['category:id,category_name', 'user:id'])->latest('publish_time')->take(2)->get(['id', 'post_heading', 'post_thumbnail', 'publish_time']);

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
