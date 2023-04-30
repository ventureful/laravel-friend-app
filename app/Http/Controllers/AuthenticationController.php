<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function signup(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);


        $user = User::create([
            'username' => $data['username'],
            'email'=>$data['email'],
            'password'=>$data['password']
        ]);

        $token =  $user->createToken($request->email)->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($res, 201);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $request->email)->first();
       
        // Mengecek saat login email/password yang sesuai
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token =  $user->createToken($request->email)->plainTextToken;

        return response()->json(['user' => $user->username, 'token'=> $token], 201);

    }

    public function logout()
    {
        $user = Auth::user();
        if (!$user) {
           return response()->json(['message'=>"Invalid credentials"], 401);
        }
        $tokenId = $user->currentAccessToken()->tokenable_id;
        $user->tokens()->where('tokenable_id',$tokenId)->delete();
        // $user->tokens()->
    }

}
