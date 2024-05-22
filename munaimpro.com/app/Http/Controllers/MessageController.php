<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /* Method for add interest information */

    public function sendMessageFromWebsite(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            $message = Message::create($validatedData);

            if($message){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Message sent successfully'
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
}
