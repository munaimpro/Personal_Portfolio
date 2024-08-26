<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use App\JWTController\JWTToken;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /* Method for signup page load */
    
    public function userSignupPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.signup', compact(['routeName']));
    }



    /* Method for user signup */
    
    public function userSignup(Request $request){
        
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|min:8|max:15',
                'password' => 'required|string|min:8|max:100',
            ]);

            if($request->hasFile('profile_picture')){
                // Validate profile picture
                $request->validate(['profile_picture' => 'image|mimes:jpeg,png,jpg|max:2048']);

                // Getting profile picture 
                $profilePicture = $request->file('profile_picture');

                // Generating unique name for profile picture
                $profilePictureName = substr(md5(time()), 0, 5).'-'.$profilePicture->getClientOriginalName();

                // Assigning profile picture name to array
                $validatedData['profile_picture'] = $profilePictureName;
                
                $user = User::create($validatedData);

                /* Store profile picture into storage/public/profile_picture folder */
                if($user){
                    $profilePicture->storeAs('profile_picture/user_images/', $profilePictureName, 'public');
                }
            } else{
                User::create($validatedData);
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'Welcome! new account created'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Signup failed. '.$e->getMessage()
            ]);
        }
        
    }



    /* Method for signin page load */
    
    public function userSigninPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.signin', compact(['routeName']));
    }



    /* Method for user signin */

    public function userSignin(Request $request){
        
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $userCheck = User::where('email', '=', $validatedData['email'])->select('id', 'first_name', 'last_name', 'profile_picture', 'password', 'role')->first();

            if($userCheck != NULL && Hash::check($request->password, $userCheck->password)){
                
                $token = JWTToken::CreateToken($userCheck->id, $request->input('email'), $userCheck->first_name, $userCheck->last_name, $userCheck->profile_picture, $userCheck->role);
                
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
                'message' => 'Signin failed '.$e->getMessage()
            ]);
        }
    }



    /* Method for user signout */

    public function userSignout(){
        return redirect('Admin/signin')->cookie('SigninToken', '', -1);
    }



    /* Method for send OTP page load */
    
    public function sendOTPPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.sendotp', compact(['routeName']));
    }



    /* Method for send OTP code */

    public function sendOTPCode(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'email' => 'required|email',
            ]);

            $email = $validatedData['email']; // Getting email
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
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'OTP could not be sent '.$e->getMessage()
            ]);
        }
    }



    /* Method for verify OTP page load */
    
    public function verifyOTPPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.verifyotp', compact(['routeName']));
    }



    /* Method for verify OTP code */

    public function verifyOTPCode(Request $request){
        try{
            
            // Input validation process for backend
            $validatedData = $request->validate([
                'email' => 'required|email',
                'otp'   => 'required',
            ]);

            $email = $validatedData['email'];
            $otp = $validatedData['otp'];

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
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'OTP could not be verified. '.$e->getMessage()
            ]);
        }
    }



    /* Method for reset password page load */
    
    public function resetPasswordPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.resetpassword', compact(['routeName']));
    }



    /* Method for reset password */

    public function resetPassword(Request $request){
        try{
            $validateData = $request->validate([
                'password' => 'required|string|min:8|max:100',
                'confirm_password' => 'required|string|min:8|max:100',
            ]);

            if($validateData['password'] !== $validateData['confirm_password']){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Confirm password not matched',
                ]);
            } else{
                $email = $request->header('userEmail'); // Email from request header
                $password = Hash::make($validateData['password']); // Password from input

                User::where('email', '=', $email)->update(['password' => $password]); // DB password update

                return response()->json([
                    'status' => 'success',
                    'message' => 'Password reset successfully',
                ])->cookie('VerifyOTPToken', '', -1);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong. '. $e->getMessage(),
            ]);
        }

    }



    /* Method for user profile page load */
    
    public function userProfilePage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.userprofile', compact(['routeName']));
    }



    /* Method for user profile */

    public function userProfile(Request $request){
        try{
            $id = $request->header('userId'); // Id from header
            
            $user = User::where('id', '=', $id)->select('first_name', 'last_name', 'email', 'phone', 'password', 'profile_picture')->first(); // Getting user data by email

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
            // Input validation process for backend
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'email' => 'required|email',
                'phone' => 'required|string',
                'profile_picture' => 'image|mimes:jpg,png,jpeg|max:2048',
            ]);

            // Getting logedin user id
            $id = $request->header('userId');

            if($request->hasFile('profile_picture')){
                
                // Retrive profile picture link from database
                $getPreviousProfilePicture = User::where('id', '=', $id)->first('profile_picture');

                // Remove file from storage
                if($getPreviousProfilePicture){
                    if(Storage::exists("public/profile_picture/user_images/".$getPreviousProfilePicture->profile_picture)){
                        Storage::delete("public/profile_picture/user_images/".$getPreviousProfilePicture->profile_picture);
                    }
                }

                // Getting new file
                $profilePicture = $request->file('profile_picture');

                // Extract the original file name with extension
                $profilePictureName = substr(md5(time()), 0, 5).'-'.$profilePicture->getClientOriginalName();
                $validatedData['profile_picture'] = $profilePictureName;

                // Update user with validated data
                $user = User::where('id', '=', $id)->update($validatedData);

                if($user){
                    $profilePicture->storeAs('profile_picture/user_images/', $profilePictureName, 'public');
                    
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Profile updated successfully'
                    ]);
                }

            } else{
                // Update user with validated data
                $user = User::where('id', '=', $id)->update($validatedData);
                
                if($user){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Profile updated successfully'
                    ]);
                } else{
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Something went wrong'
                    ]);
                }
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed! '.$e->getMessage()
            ]);
        }
    }



    /* Method for user page load */
    
    public function adminUserPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.user', compact(['routeName']));
    }



    /* Method for retreive all user */

    public function retrieveAllUserInfo(){
        try{
            $user = User::get(['id', 'first_name', 'last_name', 'phone', 'email', 'profile_picture', 'role']); // Getting all user data

            if($user){
                return response()->json([
                    'status' => 'success',
                    'message' => 'User data found',
                    'data' => $user,
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



    /* Method for retreive user by id */

    public function retrieveUserInfoById(Request $request){
        try{
            $userInfoId = $request->input('user_info_id'); // Primary key id from input
        
            $user = User::findOrFail($userInfoId, ['id', 'first_name', 'last_name', 'email', 'phone', 'profile_picture', 'role']); // Getting User data by id

            if($user){
                return response()->json([
                    'status' => 'success',
                    'message' => 'user data found',
                    'data' => $user,
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


    /* Method for update user information */

    public function updateUserInfo(Request $request){
        try {
            // Input validation process for backend
            $validatedData = $request->validate([
                'role' => 'required', Rule::in(['admin', 'user']),
                'user_info_id' => 'required|integer|exists:users,id',
            ]);
            
            // Retrieve user instance only once
            $user = User::findOrFail($validatedData['user_info_id']);
    
            // Update user with validated data
            $user->update($validatedData);
    
            return response()->json([
                'status' => 'success',
                'message' => 'User updated'
            ]);
    
        } catch(Exception $e){
            // Catch and handle exceptions
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }  


    /* Method for delete user information */

    public function deleteUserInfo(Request $request){
        try{
            // Start transaction
            DB::beginTransaction();
        
            // Getting user id from input
            $userInfoId = $request->input('user_info_id');
    
            // Retrieve user from the database
            $user = User::findOrFail($userInfoId);
    
            // Retrieve and delete the user image
            $userImage = $user->profile_picture;

            if($userImage && Storage::exists("public/profile_picture/user_images/" . $userImage)){
                if (!Storage::delete("public/profile_picture/user_images/" . $userImage)){
                    // Rollback the transaction
                    DB::rollBack();

                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Failed to delete user image'
                    ]);
                }
            }
    
            // Delete user data by id
            if (!$user->delete()){
                DB::rollBack();

                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to delete user'
                ]);
            }

            // Commit the transaction
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'User deleted'
            ]);
    
        } catch (Exception $e){
            // Rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }
}