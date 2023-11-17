<?php

namespace App\Http\Controllers;

use App\Models\Addres;
use App\Models\Baskets;
use App\Models\BasketsProducts;
use App\Models\City;
use App\Models\ColorNumberPrice;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeBasketController extends Controller
{
    public function addProduct(Request $request)
    {
        $Basket = Baskets::where('user_id','=',Auth::user()->id)
        ->where('cancel', '=', '0')
        ->where('is_payed', '=', '0')
        ->where('exit','=','0')
        ->where('is_Delete', '=', '0')
        ->first();
        $ColorNumberPrice = ColorNumberPrice::where('color_id', '=', $request->Color)
        ->where('products_id', '=', $request->Product)
        ->first();
        if ($Basket) {
            bpap($request->Product,$request->Color,$Basket,$ColorNumberPrice);
        } else {
            bpcap($request->Product,$request->Color,$ColorNumberPrice);
        }
        if($ColorNumberPrice->number > 1)
        {
            $error = false;
        } else{
            $error = true;
        }
        $Price = DiscountedPrice($request->Product,$request->Color);
        $BasketsProducts = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('is_Delete', '=', '0')
        ->get();
        $SumBasket = SumBasket($BasketsProducts);
        return response()->json(['count' => 1,'Price' => $Price,'SumBasket' => $SumBasket,'BasketProducts' => GBP($BasketsProducts),'error' => $error]);
    }
    public function basketShow()
    {
        return view('Home.Front.ShowBasket');
    }
    public function deleteBasket(Request $request)
    {
        $Basket = Baskets::where('user_id', '=',Auth::user()->id)
        ->where('cancel', '=', '0')
        ->where('is_payed', '=', '0')
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProduct = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('products_id', '=', $request->Product)
        ->where('color_id', '=', $request->Color)
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProduct->count = 0;
        $BasketsProduct->update();
        $BasketsProducts = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('is_Delete', '=', '0')
        ->get();
        $SumBasket = SumBasket($BasketsProducts);
        $Price = DiscountedPrice($request->Product,$request->Color) * $BasketsProduct->count;
        return response()->json(['count' => $BasketsProduct->count,'Price' => $Price,'SumBasket' => $SumBasket,'BasketProducts' => GBP($BasketsProducts),'Card' => Card($BasketsProducts)]);
    }
    public function pluscount(Request $request)
    {
        $Basket = Baskets::where('user_id', '=',Auth::user()->id)
        ->where('cancel', '=', '0')
        ->where('is_payed', '=', '0')
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProduct = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('products_id', '=', $request->Product)
        ->where('color_id', '=', $request->Color)
        ->where('is_Delete', '=', '0')
        ->first();
        $ColorNumberPrice = ColorNumberPrice::where('color_id', '=', $request->Color)
        ->where('products_id', '=', $request->Product)
        ->first();
        if($BasketsProduct->count + 1 < $ColorNumberPrice->number){
            $error = false;
        }
        elseif($BasketsProduct->count + 1 ==  $ColorNumberPrice->number){
            $error = true;
        }
        $BasketsProduct->count = $BasketsProduct->count + 1;
        $BasketsProduct->update();
        $BasketsProducts = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('is_Delete', '=', '0')
        ->get();
        $SumBasket = SumBasket($BasketsProducts);
        $Price = DiscountedPrice($request->Product,$request->Color) * $BasketsProduct->count;
        return response()->json(['count' => $BasketsProduct->count,'Price' => $Price,'SumBasket' => $SumBasket,'BasketProducts' => GBP($BasketsProducts),'Card' => Card($BasketsProducts),'error' => $error]);
    }
    public function minuscount(Request $request)
    {
        $Basket = Baskets::where('user_id', '=',Auth::user()->id)
        ->where('cancel', '=', '0')
        ->where('is_payed', '=', '0')
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProduct = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('products_id', '=', $request->Product)
        ->where('color_id', '=', $request->Color)
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProduct->count = $BasketsProduct->count - 1;
        $BasketsProduct->update();
        $BasketsProducts = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('is_Delete', '=', '0')
        ->get();
        $SumBasket = SumBasket($BasketsProducts);
        $Price = DiscountedPrice($request->Product,$request->Color) * $BasketsProduct->count;
        return response()->json(['count' => $BasketsProduct->count,'Price' => $Price,'SumBasket' => $SumBasket,'BasketProducts' => GBP($BasketsProducts),'Card' => Card($BasketsProducts)]);
    }

    public function basketProductDelete(Request $request)
    {
        $Basket = Baskets::where('user_id', '=',Auth::user()->id)
        ->where('cancel', '=', '0')
        ->where('is_payed', '=', '0')
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProduct = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('products_id', '=', $request->Product)
        ->where('color_id', '=', $request->Color)
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProduct->count = $BasketsProduct->count - 1;
        $BasketsProduct->update();
        $BasketsProducts = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('is_Delete', '=', '0')
        ->get();
        $SumBasket = SumBasket($BasketsProducts);
        $Price = DiscountedPrice($request->Product,$request->Color) * $BasketsProduct->count;
        return response()->json(['count' => $BasketsProduct->count,'Price' => $Price,'SumBasket' => $SumBasket,'BasketProducts' => GBP($BasketsProducts)]);
    }

    public function paymentBasket()
    {
        return view('Home.Front.Dargah');
    }

    public function basketPayment()
    {
        return view('Home.Front.BasketPayment');
    }

    public function addinfo()
    {
        $Addres = Addres::where('user_id','=',Auth::user()->id)
        ->first();
        $Address = Addres::where('user_id','=',Auth::user()->id)
        ->get();
        $Citys = City::where('is_Delete','=',0)
        ->get();
        $States = State::where('is_Delete','=',0)
        ->get();
        return view('Home.Front.AddressBasket', [
            'Addres' => $Addres,
            'Address' => $Address,
            'Citys' => $Citys,
            'States' => $States
        ]);
    }

    public function insertinfo(Request $request)
    {
        $Basket = getBasketuser();
        $Basket->addres_id = $request->Addres_id;
        $Basket->Description = $request->Description;
        $Basket->update();
        return redirect(route('BasketPayment'));
    }

    public function basketPayDone($ordernumber)
    {
        $Basket = Baskets::where('ordernumber', '=',$ordernumber)
        ->first();
        $BasketsProduct = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->get();
        return view('Home.Front.BasketPayDone', [
            'ordernumber' => $ordernumber,
            'ProductsBasket' => $BasketsProduct,
            'Basket' => $Basket
        ]);
    }

    public function basketSend()
    {
        $Baskets = Baskets::where('user_id','=',Auth::user()->id)
        ->where('is_payed','=',1)
        ->where('send','=',1)
        ->where('cancel','=',0)
        ->get();
        return view('Home.Front.BasketSend', [
            'Baskets' => $Baskets
        ]);
    }
    public function basketCanceled()
    {
        $Baskets = Baskets::where('user_id','=',Auth::user()->id)
        ->where('send','=',0)
        ->where('is_payed','=',1)
        ->where('cancel','=',1)
        ->get();
        return view('Home.Front.Basketcancelled', [
            'Baskets' => $Baskets
        ]);
    }
    public function basketContinued()
    {
        $Baskets = Baskets::where('user_id','=',Auth::user()->id)
        ->where('is_payed','=',1)
        ->get();
        return view('Home.Front.BasketContinued', [
            'Baskets' => $Baskets
        ]);
    }

    public function basketCancel($id)
    {
        $Baskets = Baskets::findOrFail($id);
        $Baskets->cancel = 1;
        $Baskets->update();
        return redirect()->back()->with('done','سبد خرید شما با موفقیت لغو شد');
    }
}