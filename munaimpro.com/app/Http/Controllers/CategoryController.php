<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\Category;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /* Method for admin skill page load */
    
    public function adminCategoryPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.category', compact(['routeName']));
    }

    
    /* Method for add category information */

    public function addCategoryInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'category_name' => 'required|string|max:255',
            ]);

            // Finding & validating duplicate category name
            $duplicateCategoryName = Category::where('category_name', $validatedData['category_name'])->first();

            if($duplicateCategoryName){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Category already exist'
                ]);
            }

            // Inserting category data
            $category = Category::create($validatedData);

            if($category){
                return response()->json([
                    'status' => 'success',
                    'message' => 'New category added'
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


    /* Method for update category information */

    public function updateCategoryInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'category_name' => 'required|string|max:255',
                'category_info_id' => '',
            ]);

            // Finding & validating duplicate category name
            $duplicateCategoryName = Category::where('category_name', $validatedData['category_name'])->first();

            if($duplicateCategoryName && $duplicateCategoryName->category_name === $validatedData['category_name']){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Category already exist'
                ]);
            }
        
            $category = Category::findOrFail($validatedData['category_info_id']);
            $category->update($validatedData);

            if($category){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category updated'
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


    /* Method for retrieve all category information */

    public function retrieveAllCategoryInfo(){
        try{
            $category = Category::get(['id', 'category_name']); // Getting all category data

            if($category){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category data found',
                    'data' => $category,
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


    /* Method for retrieve category information by id */

    public function retrieveCategoryInfoById(Request $request){
        try{
            $categoryInfoId = $request->input('category_info_id'); // Primary key id from input
        
            $category = Category::findOrFail($categoryInfoId, ['id', 'category_name']); // Getting category data by id

            if($category){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category data found',
                    'data' => $category,
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


    /* Method for delete category information */

    public function deleteCategoryInfo(Request $request){
        try{
            // Getting category id from input
            $categoryInfoId = $request->input('category_info_id');

            // Start a DB transaction
            DB::beginTransaction();

            // retrieve all post by category from database
            $posts = Post::where('category_id', '=', $categoryInfoId)->get();

            foreach($posts as $post){
                // Remove previous post thumbnail file from storage
                if($post->post_thumbnail && Storage::exists("public/post_thumbnails/".$post->post_thumbnail)){
                    Storage::delete("public/post_thumbnails/".$post->post_thumbnail);
                }

                // Delete post
                $post->delete();
            }

            // Delete category data by id
            $categoryDelete = Category::findOrFail($categoryInfoId)->delete();

            // Commit the DB transaction
            DB::commit();

            if($categoryDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category deleted'
                ]);
            } else {
                // Rollback the transaction
                DB::rollBack();

                return response()->json([
                    'status' => 'failed',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            // Rollback the transaction
            DB::rollBack();
            
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }
    }
}
