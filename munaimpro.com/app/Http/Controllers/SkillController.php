<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
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
                    'message' => 'New skill information added'
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
            $skillInfoId = $request->input('skill_info_id');
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'skill_type' => 'required|string|max:50',
                'skill_name' => 'required|string|max:50',
                'skill_percentage' => 'required|int',
            ]);
        
            $skill = Skill::findOrFail($skillInfoId);
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


    /* Method for retrive skill information */

    public function retriveSkillInfo(Request $request){
        try{
            $skillInfoId = $request->input('skill_info_id'); // Primary key id from input
        
            $skill = Skill::findOrFail($skillInfoId); // Getting skill data by id

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
