<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function showMYWallet()
    {
        $user = auth()->user();
        try {
        return response()->json([
            'name'=> $user->name ,
             'email'=>$user->email,
              'Ballance' => $user->wallet->balance,
              'serial' => $user->Wallet->seriale
        ]);
        throw new Exception ('error');
        }catch(Exception $e){
            return  "error $e";
        }
    }
}
