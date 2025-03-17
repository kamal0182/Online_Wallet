<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Container\Attributes\Auth;
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
        $transaction = Transaction::find($request->id);
        if(!$transaction){
            return response()->json([
                'message' => 'transaction Not Found'
            ]);
        }
        $sender    = $this->findUser($transaction->sender);
        $sender->balance += $transaction->amount ;
        $sender->save();
        $receiver  = $this->findUser($transaction->receiver);
        $receiver->balance -= $transaction->amount ;
        $receiver->save();
        $transaction->delete();
        return response()->json([
            "status" => "success",
            "message"=> "Rollback operation completed successfully."
        ]);
     }
     public function findUser($id)
     {
        $user =  User::find($id);
        if($user){

            return $user->Wallet ;
        }
     }
    public function alltransacions()
    {
        // return "hello";
        // return auth()->user()->transactionsReciever() ;
        try {
            // $user =  auth()->user();
            // return Transaction::all();
            $user = User::find(auth()->user()->id);
            return $user->transactionsSender ;
            // return Auth::user()->transactionsSender();
            throw new Exception("error ");
        }catch(Exception $e){
            return "344o4 $e";
        }

    }

}
