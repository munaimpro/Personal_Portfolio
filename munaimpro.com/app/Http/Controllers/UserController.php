<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\JWTController\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /* Method for signup page load */
    
    public function userSignupPage(){
        return view();
    }



    /* Method for user signup */
    
    public function userSignup(Request $request){
        
        try{
            if($request->hasFile('profile_picture')){
                $profilePicture = $request->file('profile_picture');

                /* Merge profile picture into array */
                $userData = array_merge($request->input(), ['profile_picture' => $profilePicture]);
                
                $user = User::create($userData);

                /* Store profile picture into storage/public/profile_picture folder */
                if($user){
                    $profilePicture->store('profile_picture', 'public');
                }
            } else{
                User::create($request->input());
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'Welcome! new account created'
            ]);
        } catch(Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'message' => 'Signup failed'.$e->getMessage()
            ]);
        }
        
    }



    /* Method for signin page load */
    
    public function userSigninPage(){
        return view();
    }



    /* Method for user signin */

    public function userSignin(Request $request){
        
        try{
            $userCheck = User::where('email', '=', $request->email)->select('id', 'password')->first();

            if($userCheck != NULL && Hash::check($request->password, $userCheck->password)){
                
                $token = JWTToken::CreateToken($request->input('email'), $userCheck->id);
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Signin successfully',
                ])->cookie('SigninToken', $token, time()+60*60);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Data not found',
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Signin failed'.$e->getMessage()
            ]);
        }
    }



    /* Method for user signout */

    public function userSignout(){
        return redirect('Admin/signin')->cookie('SigninToken', '', -1);
    }



    /* Method for send OTP page load */
    
    public function sendOTPPage(){
        return view();
    }



    /* Method for send OTP code */

    public function sendOTPCode(Request $request){
        $email = $request->input('email'); // Email input
        $otp = rand(1000, 9999); // OTP number geneartion
        $userCount = User::where('email', '=', $email)->count(); // User count for availability in DB

        if($userCount == 1){
            Mail::to($email)->send(new OTPMail($otp)); // Sending mail to email address
            User::where('email', '=', $email)->update(['otp' => $otp]); // Update OTP code in user table

            return response()->json([
                'status' => 'success',
                'message' => '4 digit otp code has been send to your mail',
            ]);
        } else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found',
            ]);
        }
    }



    /* Method for verify OTP page load */
    
    public function verifyOTPPage(){
        return view();
    }



    /* Method for verify OTP code */

    public function verifyOTPCode(Request $request){
        $email = $request->input('email');
        $otp = $request->input('otp');

        $countUser = User::where('email', '=', $email)->where('otp', '=', $otp)->count();

        if($countUser == 1){
            User::where('email', '=', $email)->update(['otp' => '0']);
            
            $token = JWTToken::createTokenForResetPassword($email);
            
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Verification successful',
            ])->cookie('VerifyOTPToken', $token, time()+60*5);
        } else{
            return response()->json([
                'status' => 'failed',
                'message' => 'OTP not found',
            ]);
        }
    }



    /* Method for reset password page load */
    
    public function resetPasswordPage(){
        return view();
    }



    /* Method for reset password */

    public function resetPassword(Request $request){
        try{
            $email = $request->header('userEmail'); // Email from request header
            $password = Hash::make($request->input('password')); // Password from input
            User::where('email', '=', $email)->update(['password' => $password]); // DB password update

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully',
            ])->cookie('VerifyOTPToken', '', -1);
        } catch(Exception $exception){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong',
            ]);
        }

    }



    /* Method for user profile page load */
    
    public function userProfilePage(){
        return view();
    }



    /* Method for user profile */

    public function userProfile(Request $request){
        try{
            $email = $request->header('userEmail'); // Email from header
            
            $user = User::where('email', '=', $email)->select('first_name', 'last_name', 'email', 'password', 'profile_picture')->first(); // Getting user data by email

            if($user){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request success',
                    'data' => $user
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Data not found'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
    }



    /* Method for user profile update */

    public function updateProfile(Request $request){
        try{
            $email = $request->header('userEmail');

            if($request->hasFile('profile_picture')){
                
                // Retrive profile picture link from database
                $getPreviousProfilePicture = User::where('email', '=', $email)->first('profile_picture');

                // dd($getPreviousProfilePicture->profile_picture);

                // Remove file from storage
                if($getPreviousProfilePicture){
                    if(Storage::exists("public/".$getPreviousProfilePicture->profile_picture)){
                        Storage::delete("public/".$getPreviousProfilePicture->profile_picture);
                    }
                }

                // Stored new file to the storage
                $profilePicture = $request->file('profile_picture')->store('profile_picture', 'public');

                User::where('email', '=', $email)->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'profile_picture' => $profilePicture,
                    'password' => Hash::make($request->input('password')),
                ]);
        
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile updated successfully'
                ]);
            } else{
                User::where('email', '=', $email)->update([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                ]);
        
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile updated successfully'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'.$e->getMessage()
            ]);
        }
    }
}