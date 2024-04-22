<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(! Auth::attempt($validated)){
            return response()->json([
               'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $validated['email'])->first();


        return response() -> json([
            "access_token" => $user->createToken('api_token') -> plainTextToken,
            "token_type" => "Bearer"
        ]);
    }

    public function register(Request $request) 
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:50',
            'middleName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $validated['registedAt'] = Date::now();
        $validated['lastLogin'] = Date::now();

        $user = User::create($validated);

        return response() -> json([
            'data' => $user,
            "access_token" => $user->createToken('api_token') -> plainTextToken,
            "token_type" => "Bearer"
        ], 201);
    }
}
