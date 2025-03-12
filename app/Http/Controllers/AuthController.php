<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $newUser = User::create(
                [
                    'name'=>$request->input('name'),
                    'email'=>$request->input('email'),
                    'password'=> Hash::make($request->input('password'))
                ]
            );
        return $newUser ;
    }
    public function login(Request $request)
    {
        $user = User::where('email' ,$request->email)->first();
        if(!$user)
        {
            return response()->json([
                'message' => 'email Not Found'],401 );
        }
        if(!Hash::check($request->input('password'), $user->password))
        {
            return response()->json([
                'message' => 'password  Not Found'],401
            );
        }


    $token = $user->createToken('WALLET_API')->plainTextToken;
        return response()->json([
            "token"=>$token
        ]);

    }
}
