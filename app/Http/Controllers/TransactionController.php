<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Redis;

class TransactionController extends Controller
{
    public function sendMoney(Request $request)
    {
                try{
                    $user = User::where('email',$request->email)->first();
                if($user){
                    if($user->name != $request->name){
                        return response()->json(['message' => "name doesn't match user name"]);
                    }
                }
                else {
                    return response()->json(['message' => "email  not found"]);
                }
                $sender = auth()->user();
                if($sender->wallet->balance < $request->amount){
                return   response()->json(['message' => "you don't have enough Money"]);
                }
            }
            catch(Exception $e){
                return "Error $e";
            }
            FacadesDB::begintransaction();
            try {
                $receiverwallet = $user->wallet ;
                $receiverwallet->balance  += $request->amount ;
                $receiverwallet->save();
                $senderwallet = $sender->wallet ;
                $senderwallet->balance -= $request->amount ;
                $senderwallet->save();

                //  Transaction::create([
                //     'amount' => $request->amount ,
                //     'sender' => $sender->id ,
                //     'receiver' => $user->id,
                //     'admin' => null
                // ]);
                $transaction =   Transaction::create([
                    'amount' => $request->amount ,
                    'sender' => $sender->id ,
                    'receiver' => $user->id,
                    'admin' => null
                ]);
                FacadesDB::commit();


                return response()->json( ['message' => "added successfully",
                                        'sender' => $senderwallet->balance ,
                                        'receiver' => $receiverwallet->balance ,
                                         'transaction' => $transaction ]);
            }catch(Exception $e){
                FacadesDB::rollback() ;
            }

    }
    public function rollback(Request $request)
    {
        FacadesDB::begintransaction();
        // try {
        //         $transacrtion =  Transaction::find($request->id);
        //         DB::rollback() ;
        //     }
    }
}
