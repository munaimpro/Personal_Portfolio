<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Message;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use App\Mail\AdminMessageMail;
use App\Mail\ClientMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class MessageController extends Controller
{
    /* Method for admin interest page load */
    
    public function adminMessagePage(){
        // Getting SEO properties for specific view
        $seoproperty = Seoproperty::where('page_name', 'index')->firstOrFail();
        
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.message', compact(['seoproperty', 'routeName']));
    }


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
                // Getting admin email
                $adminEmail = User::where('role', 'admin')->value('email');
                
                // Send email notification
                Mail::to($adminEmail)->send(new ClientMessageMail($validatedData['email'], $validatedData['subject'], $validatedData['message']));

                return response()->json([
                    'status' => 'success',
                    'message' => 'Message sent successfully'
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



    /* Method for send message from admin */

    public function sendMessageFromAdmin(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'email' => 'required|email|max:100',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);
            
            // dd($message);
            
            $sendMessage = Mail::to($validatedData['email'])->send(new AdminMessageMail($validatedData['email'], $validatedData['subject'], $validatedData['message']));

            if($sendMessage){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Message sent successfully'
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

    public function retriveMessageInfoById(Request $request){
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

    public function retriveAllMessageInfo(){
        try{
            // Getting all message
            $message = Message::get(['id', 'name', 'email', 'subject', 'message', 'created_at']);

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
