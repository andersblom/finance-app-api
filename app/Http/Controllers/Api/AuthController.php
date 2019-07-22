<?php

namespace App\Http\Controllers\Api;

use App\User;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        if ($validator->fails())
        {
            return response([
                'errors' => $validator->errors()->all()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->toArray());
    
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
    
        return response([
            'token' => $token,
            'user' => $user,
        ], Response::HTTP_OK);
    }
    
    public function login (Request $request) {
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $user['token'] = $token;
                return response($user, Response::HTTP_OK);
            } 
        } else {
            return response([], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
    
        return response([], Response::HTTP_OK);
    }
}
