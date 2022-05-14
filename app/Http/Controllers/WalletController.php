<?php

namespace App\Http\Controllers;

use AmrShawky\Currency;
use App\Http\Requests\AddTransactionRequest;
use App\Http\Requests\GetBalanceRequest;
use App\Models\Transaction;
use App\Models\Wallet;
use Exception;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function getBalance(GetBalanceRequest $request)
    {
        $wallet = Wallet::find($request->wallet_id);
        return response()->json(['balance' => $wallet->balance]);
    }
    public function addTransaction(AddTransactionRequest $request)
    {
        $wallet = Wallet::find($request->wallet_id);
        if ($request->currency != $wallet->currency) {
            $value = Currency::convert()->from($request->currency)->to($wallet->currency)->amount($request->value);
        }
        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => $request->type,
                'value' => $value,
                'reason' => $request->reason,
            ]);
            $wallet->updateBalance($transaction->type, $transaction->value);
        } catch (Exception $e) {
            logger('CreateTransactionFailed', ['message' => $e->getMessage()]);
            DB::rollBack();
            return response()->json(['message' => 'CreateTransactionFailed'], 500);
        }
        DB::commit();

        return response()->json();
    }
}
