<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
        $role    =  Role::where('name',$request->role)->first();
        $user =  User::where('email',$request->email)->first();
        if($user) return response()->json(['message' => 'this email is already existe']);
        if($role){
            // return $role->id ;

                $newUser = User::create(
                    [
                        'name'=>$request->input('name'),
                        'email'=>$request->input('email'),
                        'password'=> Hash::make($request->input('password')),
                        'role_id' => $role->id
                    ]
                );

            // return $newUser;

        Wallet::create([
            'user_id' => $newUser->id ,
            'seriale' => mt_rand(1, 1000),
            'status' => 'validated',
            'balance' => $request->wallet['ballance']
        ]);
       return response()->json([
        'user'=>$newUser ,
        'role' => $role
       ]);
        }
        throw new Exception('error');
    }
    catch(Exception $e){
        echo "eroor $e";

    }
    }
    public function login(Request $request)
    {
        // return $request->email;
        $user = User::where('email' ,$request->email)->first();
        // return $user ;
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
        // return $user ;
    try {
        $token = $user->createToken('WALLET_API')->plainTextToken;
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            "token"=>$token
        ]);
        // throw new Exception('error');
    }catch(Exception $e){
        return "error $e";
    }
    // return $token ;

    }
}
