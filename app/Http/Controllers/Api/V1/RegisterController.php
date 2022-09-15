<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        
        $data['password'] = bcrypt($request->password);
        
        $user = User::create($data);
        
        $token = $user->createToken('API Token')->accessToken;
        $response = [ 'user' => $user, 'token' => $token];
        return response($response, 200);
    }
}
