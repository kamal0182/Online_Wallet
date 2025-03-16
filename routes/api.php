<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('hello',function()
{
    return response()->json([
        'message' => "hello world"
    ]) ;
});
Route::post('/register' , [AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/wallet',[WalletController::class,'showMYWallet'])->middleware('auth:sanctum');
Route::post('/wallet',[AuthController::class,'AddMoneyToMyWollet'])->middleware('auth:sanctum');
Route::post('/transaction',[TransactionController::class, 'sendMoney'])->middleware('auth:sanctum');
Route::post('/admin/rollback/{id}',[TransactionController::class,'rollback'])->middleware('admin');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
