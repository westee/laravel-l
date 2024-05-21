<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    /**
     * Registro de usuarios
     */
    public function register(LoginRequest $request){
        $this->validate($request,[
            'name' => 'required|max:255|',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ],201);
    }

    /**
     * Ingresar
     * LoginRequest: validate
     */
    public function login(Request $request){
        $crendencials = $request->only('email','password');

        try{
            if(!$token = JWTAuth::attempt($crendencials)){
                return response()->json([
                    'error'=>'invalid credentials'
                ], 400);
            }

        }catch(JWTException $e){
            return response()->json([
                'error' => 'not create token'
            ], 500);
        }
        // success
        return response()->json(compact('token'));

    }
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (!Auth::attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $user = Auth::user();
    //     $token = JWTAuth::fromUser($user);

    //     return response()->json(['token' => $token], 200);
    // }
}
