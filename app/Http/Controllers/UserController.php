<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function register(Request $request) {
        $this->validate($request, [
            "name"     => "required|min:3",
            "email"    => "required|email|unique:users",
            "password" => "required|min:6"
        ]);

        $user = new User;
        $user = $user->create([
           "name"       => $request->name,
           "email"      => $request->email,
           "password"   => bcrypt($request->password),
           "api_token"  => bcrypt($request->email) 
        ]);

        $response = (new UserResource($user))->token(bcrypt($request->email));
        return response()->json($response, 201);
    }

    public function login(Request $request) {
        if(!Auth::attempt([
            "email" => $request->email, "password" => $request->password
        ])) {
           return response()->json([
                "error" => "unauthorized"
           ], 401); 
        }

        $user = User::find(Auth::user()->id);
        $response = (new UserResource($user))->token($user->api_token);
        return response()->json($response, 200);
    }

    public function testuser() {
        $users = User::all();
        return UserResource::collection($users);
    }
}
