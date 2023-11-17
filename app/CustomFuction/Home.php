<?php

use App\Models\Baskets;
use App\Models\BasketsProducts;
use App\Models\Berands;
use App\Models\Category;
use App\Models\ColorNumberPrice;
use App\Models\FaveritProduct;
use App\Models\Products;
use App\Models\wallets;
use Illuminate\Support\Facades\Auth;

function Berands()
{
    return $Berands = Berands::where('is_Delete','=',0)
    ->where('is_show','=',1)
    ->limit(8)
    ->get();   
}
function Products()
{
    return $Products = Products::where('is_Delete','=','0')
    ->get(); 
}
function Categorysindex()
{
    return $Categorys = Category::where('is_Delete','=','0')
    ->where('showhome','=','1')
    ->orderBy('updated_at','asc')
    ->limit(8)
    ->get();
}
function Categorys()
{
    return $Categorys = Category::where('is_Delete','=','0')
    ->where('showhome','=','1')
    ->orderBy('updated_at','asc')
    ->get();
}

function Productsdiscount()
{
    return $Productsdiscount = Products::where('is_Delete','=','0')
    ->limit(8)
    ->get();
}

function Color($Product)
{
    $ColorNumberPrice = ColorNumberPrice::where('products_id','=',$Product->id)
    ->where('number','>',0)
    ->orderBy('price','asc')
    ->first();
    return $ColorNumberPrice->Color();    
}

// basket Prodcuts User
function bpu()
{
    if(Auth::user())
    {
        $Baskets = Baskets::where('user_id','=',Auth::user()->id)
        ->where('is_Delete','=',0)
        ->where('cancel','=',0)
        ->where('is_payed','=',0)
        ->first();
        return $BasketsProducts = BasketsProducts::where('baskets_id','=',$Baskets->id)
        ->where('is_Delete','=',0)
        ->get();
    }
}

function FPL()
{
    $FaveritProducts = FaveritProduct::where('user_id','=',Auth::user()->id)->get();
    if(count($FaveritProducts) > 0){
        $data = '<div class="FaviritProduct">
        <div class="headline-profile">
            <span>لیست علاقه مندی</span>
        </div>
        <div class="profile-stats">';
        foreach ($FaveritProducts as $FaveritProduct)
        {
           $data = $data .' <div class="profile-recent-fav">
            <a href="'.route("ShowProduct",["P_id" => $FaveritProduct->Products()->P_id ,"Name" => $FaveritProduct->Products()->Name , "Color" => Color($FaveritProduct->Products()) ]).'" class="profile-recent-fav-col">
                <img src="'.asset("images/Products-image/".$FaveritProduct->Products()->img).'">
            </a>
            <div class="profile-recent-fav-col-title">
                <a href="#">
                    <h3 class="profile-recent-fav-name">'.$FaveritProduct->Products()->title.'</h3>
                </a>
            </div>
            <div class="profile-recent-fav-price">
                '.number_format($FaveritProduct->Products()->leastPrice).'<span>تومان</span>
            </div>
            <div class="profile-recent-fav-col-actions">
                <button data-id="'.$FaveritProduct->Products()->id.'" class="js-remove-favorite-product DisLikebtn"><i class="fa fa-trash"></i></button>
            </div>
        </div>';
        }
        $data = $data . '</div></div>';
    }else{
        $data = '<div class="FaviritProduct">
        <div class="headline-profile">
            <span>لیست علاقه مندی</span>
        </div>
        <div class="profile-stats">
            <div class="profile-return-box">
                <p class="profile-return-message">متاسفانه علاقه مندی های شما خالی است</p>
            </div>
        </div>';
            $data = $data . '</div></div>';
        }
  
        return $data;
}
function getwallet()
{
    $wallet = wallets::where('user_id','=',Auth::user()->id)
    ->first();
    if($wallet != null)
    {
        return $wallet->price;
    }else{
        return 0 ;
    }
     
}
function getUser()
{
    if(Auth::user())
    {
        return Auth::user();
    }else{
        return null;
    }
}