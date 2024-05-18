<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT; // Use Built-in class JWT
use Firebase\JWT\Key; // Use Built-in class Key

class JWTToken
{
		/** Method for create token */
		
    static function CreateToken($userEmail, $userId):string{
        $key = env('JWT_KEY');

        $payload = [
            'iss' => 'laravel', // Token Issuar
            'iat' => time(), // Token Issued At
            'exp' => time()+60*60, // Token Expire Time
            /**
            * User email and user id passed to token to find after token decode 
            */
            'userEmail' => $userEmail,
            'userId' => $userId
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
		
		
		/**
		* Method for create token for reset password 
		* Token creation process can be implemented for any purpous
		*/
		
    static function CreateTokenForResetPassword($userEmail):string{
        $key = env('JWT_KEY');

        $payload = [
            'iss' => 'laravel',
            'iat' => time(),
            'exp' => time()+60*5,
            'userEmail' => $userEmail,
            'userId' => 0
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
		
		
		/**
		* Method for verify token
		* Further authorized access will be controlled by calling this method
		*/
		
    static function VerifyToken($token):string|object{
        try{
            if($token){
                $key = env('JWT_KEY');
                $decode = JWT::decode($token, new Key($key, 'HS256'));
                return $decode;
            } else{
                return "Unauthorized";
            }
            
        } catch(Exception $e){
            return "Unauthorized";
        }
    }

}
