<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        try {
            $validateUser = Validator::make($request->all(), [
                "name"=> "required",
                "displayName"=> "",
                "email"=> "required|email|unique:users,email",
                "password"=> "required",
                "profile_picture"=> "required"
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    "status"=> false,
                    "message"=> "Validation failed",
                    "errors"=> $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                "name" => $request->name,
                "displayName" => $request->displayName ? $request->displayName : "user-".rand(0, 9999),
                "email" => $request->email,
                "password" => $request->password,
                "profile_picture"=> $request->profile_picture
            ]);

            return response()->json([
                "status"=> true,
                "message"=> "User created successfully",
                "token"=> $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        }catch (\Throwable $th){
            return response()->json([
                "status"=> false,
                "message"=> $th->getMessage(),
                "error"=> $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request) {
        $valideUser = Validator::make($request->all(), [
            "email"=> "required|email",
            "password"=> "required"
        ]);

        if ($valideUser->fails()) {
            return response()->json([
                "status"=> false,
                "message"=> "Validation failed",
                "errors"=> $valideUser->errors()
            ], 401);
        }

        $user = User::where("email", $request->email)->first();

        if (!Auth::attempt($request->only(["email", "password"]))) {
            return response()->json([
                "status"=> false,
                "message"=> "Email or Password dont match"
            ], 401);
        }

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "status"=> true,
            "message"=> "User logged in successfully",
            "access_token"=> $token,
            "token_type"=> "Bearer"
        ], 200);
    }

    public function me(Request $request) {
        $userData = auth()->user();
        return response()->json([
            "status"=> true,
            "message"=> "Profile information",
            "data"=> $userData,
            "id"=> auth()->user()->id
        ], 200);
    }

    public function logout(Request $request) {

        $request->user()->tokens()->delete();

        return response()->json([
            "status"=> true,
            "message"=> "User logged out successfully"
        ], 200);
    }
}
