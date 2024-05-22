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



    /* Method for reply message from admin */

    public function replyMessageFromAdmin(Request $request){
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
            
            $replyMessage = Mail::to($email)->send(new AdminMessageMail($email, $subject, $adminMessage)); 

            if($replyMessage){
                // Update message status to "replied" in message table
                Message::where('email', '=', $email)->update(['message_status' => 'replied']);

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


    /* Method for retrive message by id */

    public function retriveMessageById(Request $request){
        try{
            $messageId = $request->input('message_id'); // Primary key id from input
        
            $message = Message::findOrFail($messageId, ['id', 'name', 'email']); // Getting message data by id

            if($message){
                // Update message status to "viewed" in message table
                Message::where('id', '=', $messageId)->update(['message_status' => 'viewed']);

                return response()->json([
                    'status' => 'success',
                    'message' => 'message data found',
                    'data' => $message,
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


    /* Method for retrive all message */

    public function retriveAllMessage(){
        try{
            // Getting all message
            $message = Message::get(['id', 'name', 'email', 'subject', 'message']);

            if($message){
                return response()->json([
                    'status' => 'success',
                    'message' => 'message data found',
                    'data' => $message,
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


    /* Method for delete message */

    public function deleteMessage(Request $request){
        try{
            // Getting message id from input
            $messageId = $request->input('message_id');
            
            // Delete message by id
            $messageDelete = Message::findOrFail($messageId)->delete(); 

            if($messageDelete){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Message deleted'
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
