<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\AdminMessageMail;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /* Method for send message from website */

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



    /* Method for send message from admin */

    public function sendMessageFromAdmin(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'email' => 'required|email|max:100',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            $email = $request->input('email');
            $subject = $request->input('subject');
            $adminMessage = $request->input('message');
            
            // dd($message);
            
            $sendMessage = Mail::to($email)->send(new AdminMessageMail($email, $subject, $adminMessage));

            if($sendMessage){
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
