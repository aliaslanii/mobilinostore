<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\wallets;
use Illuminate\Support\Facades\Auth;

class HomeWalletController extends Controller
{
    public function chargeWallet()
    {
        $wallet = wallets::where('user_id','=',Auth::user()->id)
        ->first();
        if($wallet){
            $wallet->price += SumBasket(bpu());
            $wallet->update();
            return payedBasket($wallet);
        }else{
            $wallet = new wallets();
            $wallet->user_id = Auth::user()->id;
            $wallet->price = SumBasket(bpu());
            $wallet->save();
            return payedBasket($wallet);
        }
    }
}
