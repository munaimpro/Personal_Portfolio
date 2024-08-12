<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CategoryController extends Controller
{
    /* Method for admin skill page load */
    
    public function adminCategoryPage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.category', compact(['seoproperty', 'routeName']));
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
            $categoryInfoId = $request->input('category_info_id');
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'category_name' => 'required|string|max:255',
            ]);
        
            $category = Category::findOrFail($categoryInfoId);
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


    /* Method for retrive all category information */

    public function retriveAllCategoryInfo(){
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


    /* Method for retrive category information by id */

    public function retriveCategoryInfoById(Request $request){
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
            
            // Delete category data by id
            $categoryDelete = Category::findOrFail($categoryInfoId)->delete(); 

            if($categoryDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category deleted'
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
