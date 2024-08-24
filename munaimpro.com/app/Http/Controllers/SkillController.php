<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Skill;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SkillController extends Controller
{
    /* Method for admin skill page load */
    
    public function adminSkillPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.skill', compact(['routeName']));
    }


    /* Method for add skill information */

    public function addSkillInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'skill_type' => 'required|string|max:50',
                'skill_name' => 'required|string|max:50',
                'skill_percentage' => 'required|int',
            ]);

            $skill = Skill::create($validatedData);

            if($skill){
                return response()->json([
                    'status' => 'success',
                    'message' => 'New skill added'
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


    /* Method for update skill information */

    public function updateSkillInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'skill_type' => 'required|string|max:50',
                'skill_name' => 'required|string|max:50',
                'skill_percentage' => 'required|int',
                'skill_info_id' => '',
            ]);
        
            $skill = Skill::findOrFail($validatedData['skill_info_id']);
            $skill->update($validatedData);

            if($skill){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Skill information updated'
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


    /* Method for retrive all skill information */

    public function retriveAllSkillInfo(Request $request){
        try{
            $skill = Skill::get(['id', 'skill_type', 'skill_name', 'skill_percentage']); // Getting all skill data

            if($skill){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Skill data found',
                    'data' => $skill,
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


    /* Method for retrive skill information by id */

    public function retriveSkillInfoById(Request $request){
        try{
            $skillInfoId = $request->input('skill_info_id'); // Primary key id from input
        
            $skill = Skill::findOrFail($skillInfoId, ['id', 'skill_type', 'skill_name', 'skill_percentage']); // Getting skill data by id

            if($skill){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Skill data found',
                    'data' => $skill,
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


    /* Method for delete education information */

    public function deleteSkillInfo(Request $request){
        try{
            // Getting education id from input
            $skillInfoId = $request->input('skill_info_id');
            
            // Delete education data by id
            $skillDelete = Skill::findOrFail($skillInfoId)->delete(); 

            if($skillDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Skill information deleted'
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
