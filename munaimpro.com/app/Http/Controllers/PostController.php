<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /* Method for add post information */

    public function addPostInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'post_heading' => 'required|string|max:255',
                'post_slug' => 'required|string|max:255',
                'post_thumbnail' => 'required|image',
                'post_descrption' => 'required|string',
                'category_id' => 'required|integer',
                'publish_time' => 'required|string',
                'post_status' => 'required|string',
            ]);

            $userId = $request->header('userId'); // User ID from header

            if($request->hasFile('post_thumbnail')){
                /* Getting file */
                $postThumbnail = $request->file('post_thumbnail');

                /* Extract the original file name with extension */
                $postThumbnailName = $postThumbnail->getClientOriginalName();
                $postThumbnailUniqueName = substr(md5(time()), 0, 5).'-'.$postThumbnailName;

                /* Merge thumbnail image into array */
                $postData = array_merge($validatedData, ['post_thumbnail' => $postThumbnailUniqueName, 'user_id' => $userId]);

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
    


    /* Method for update post information */

    public function updatePostInfo(Request $request){
        try{
            $postInfoId = $request->input('post_info_id');
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'post_heading' => 'required|string|max:255',
                'post_slug' => 'required|string|max:255',
                'post_thumbnail' => 'image',
                'post_descrption' => 'required|string',
                'category_id' => 'required|integer',
                'user_id' => 'required|integer',
                'publish_time' => 'required|string',
                'post_status' => 'required|string',
            ]);

            $userIdFromHeader = $request->header('userId'); // User ID from header
            $userIdFromInput = $request->input('userId'); // User ID from input

            // Matching both user id for validated post owner
            if($userIdFromHeader === $userIdFromInput){

                if($request->hasFile('post_thumbnail')){
                    // Retrive post thumbnail link from database
                    $getPreviousPostThumbnail = Post::where('id', '=', $postInfoId)->first('post_thumbnail');

                    // Remove previous post thumbnail file from storage
                    if($getPreviousPostThumbnail){
                        if(Storage::exists("public/post_thumbnail/".$getPreviousPostThumbnail->post_thumbnail)){
                            Storage::delete("public/post_thumbnail/".$getPreviousPostThumbnail->post_thumbnail);
                        }
                    }

                    // Getting new post thumbnail file
                    $postThumbnail = $request->file('post_thumbnail');

                    /* Extract the original file name with extension */
                    $postThumbnailName = $postThumbnail->getClientOriginalName();
                    $postThumbnailUniqueName = substr(md5(time()), 0, 5).'-'.$postThumbnailName;
    
                    /* Merge thumbnail image into array */
                    $postData = array_merge($validatedData, ['post_thumbnail' => $postThumbnailUniqueName]);
    
                    $post = Post::findOrFail($postInfoId)->update($postData);
    
                    /* Store post thumbnail into storage/public/post_thumbnails folder */
                    if ($post){
                        $postThumbnail->storeAs('post_thumbnails', $postThumbnailUniqueName, 'public');
                    }
                } else{
                    Post::findOrFail($postInfoId)->update($validatedData);
                }
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'post updated'
                ]);

            } else{
                return redirect()->back();
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
            $post = Post::with(['category', 'user'])->get();

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
            $postInfoId = $request->input('post_info_id'); // Primary key id from input
            
            // Getting post data by id with category and user
            $post = Post::with(['category', 'user'])->findOrFail($postInfoId);

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
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }
}
