<?php

// basket Products found

use App\Models\Baskets;
use App\Models\BasketsProducts;
use App\Models\ColorNumber;
use App\Models\ColorNumberPrice;
use App\Models\invoice;
use App\Models\Products;
use App\Models\wallets;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;


// status Code getBasketuser

// 0 -> Defult
// 1 -> loading
// 2 -> exit
// 3 -> send
// 4 -> cancel

// basket product add product
function bpap ($Product,$Color,$Basket)
{
    $BasketsProducts = BasketsProducts::where('baskets_id','=',$Basket->id)
    ->where('products_id','=',$Product)
    ->where('color_id','=',$Color)
    ->first();
    if($BasketsProducts)
    {
        $BasketsProducts->count = $BasketsProducts->count +1;
        $BasketsProducts->update();
    }
    else
    {
        $BasketsProducts = new BasketsProducts();
        $BasketsProducts->baskets_id = $Basket->id;
        $BasketsProducts->products_id = $Product;
        $BasketsProducts->color_id = $Color;
        $BasketsProducts->count = 1;
        $BasketsProducts->save();
    }
}
// basket product create add product
function bpcap ($Product,$Color)
{
    $Basket = new Baskets();
    $Basket->user_id = Auth::user()->id;
    $Basket->ordernumber = 'MSP-20000327'.random_int(100000,9999999);
    $Basket->save(); 
    $BasketProducts = new BasketsProducts();
    $BasketProducts->baskets_id = $Basket->id;
    $BasketProducts->products_id = $Product;
    $BasketProducts->color_id = $Color;
    $BasketProducts->count = 1;
}


// Plus Count Baket
function PCB ($Product,$Color,$Basket)
{
    $BasketsProduct = BasketsProducts::where('baskets_id', '=',$Basket->id)
    ->where('products_id', '=', $Product)
    ->where('color_id', '=', $Color)
    ->where('is_Delete', '=', '0')
    ->first();
    $ColorNumberPrice = ColorNumberPrice::where('color_id', '=', $Color)
    ->where('products_id', '=', $Product)
    ->first();
    
    if($BasketsProduct != null)
    {
        if($BasketsProduct->count == $ColorNumberPrice->number)
        {
            return true;
        }
        return false;
    }
    return false;
}

function SumBasket($ProducsBasket)
{
    $sumBasketPrice =  0;
    if($ProducsBasket)
    {
        foreach($ProducsBasket as $ProducBasket)
        {
            if($ProducBasket->is_Delete == 0)
            {
                if($ProducBasket->Products()->SumNumber > 0)
                {
                    $Sumrow = $ProducBasket->count * DiscountedPrice($ProducBasket->Products()->id,$ProducBasket->Color()->id);
                    $sumBasketPrice += $Sumrow;
                }
            }
        }
        return $sumBasketPrice;
    }
}

function Sumrow($ProducBasket)
{
    return $Sumrow = DiscountedPrice($ProducBasket->Products()->id,$ProducBasket->Color()->id) * $ProducBasket->count;    
}

function ProductBasketPrice($ProducBasket)
{
    return $Sumrow = $ProducBasket->count * DiscountedPrice($ProducBasket->Products()->id,$ProducBasket->Color()->id);
}

function generatBasketsProducts($Basket)
{
    $num = 1;
    $data = '<div class="modal-content modal-content-demo table-BasketsProducts">
    <div class="modal-header">
       <h6 class="modal-title">محصولات سبد</h6><button class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
    </div>
        <div class="modal-body">
        <h6 class="modal-title">نام مشتری : '.$Basket->Addres()->Name.'</h6>
        <h6 class="modal-title">شماره تماس : '.$Basket->Addres()->Mobile.'</h6>
        <h6 class="modal-title">استان : '.$Basket->Addres()->states()->State.'</h6>
        <h6 class="modal-title">شهر : '.$Basket->Addres()->cities()->City.'</h6>
        <h6 class="modal-title">آدرس : '.$Basket->Addres()->Address.'</h6>
        <h6 class="modal-title">آدرس : '.$Basket->Addres()->ZipCode.'</h6>
        <h6 class="modal-title">آدرس : '.$Basket->Addres()->Plate.'</h6>
        <h6 class="modal-title">آدرس : '.$Basket->Addres()->Unit.'</h6>
        <h6 class="modal-title">قیمت کل سفارش : '.number_format(SumBasket($Basket->BasketsProducts())).'</h6>
    </div>
    <div class="modal-body">
       <div class="table_section padding_infor_info"><div class="table-responsive-sm"><table class="table border text-md-nowrap text-nowrap data-table-Berand">
        <thead>
        <tr>
            <th>#</th>
            <th>تصویر محصول</th>
            <th>نام محصول</th>
            <th>رنگ محصول</th>
            <th>قیمت واحد</th>
            <th>تعداد</th>
            <th>قیمت نهایی</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($Basket->BasketsProducts() as $ProducBasket){
            if ($ProducBasket->count > 0) {
                if ($ProducBasket->is_Delete == 0){
                    $data = $data . '<tr class="cart_item">
                    <td>'.$num.'</td>
                    <td>
                        <img style="width: 4rem;" class="img-responsive" src="'.asset("images/Products-image/".$ProducBasket->Products()->img).'">
                    </td>
                    <td>
                        '.$ProducBasket->Products()->title.'    
                    </td>
                    <td>
                        <span>'.$ProducBasket->Color()->Name.'</span>
                    </td>
                    <td>
                      '.number_format(DiscountedPrice($ProducBasket->Products()->id,$ProducBasket->Color()->id)).'
                    </td>
                    <td>
                            '.$ProducBasket->count.'
                    </td>
                    <td>'.number_format(Sumrow($ProducBasket)).'
                    </td>
                </tr>';
                $num ++;
                }
            } 
            
        } 
        $data = $data .'</tbody></table></div> </div>
        </div>
        <div class="modal-footer">
           <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">بستن</button>';
            if($Basket->Status == 1)
            {
                $data = $data . '<a href="javascript:boid(0)" data-id="'.$Basket->id.'" class="btn ripple btn-primary text-white send-Basket">ارسال سبد</a></div></div>';
            }elseif($Basket->Status == 4){
                $data = $data . '<a href="javascript:boid(0)"  class="btn ripple btn-primary text-white disabled">سبد لغو شده است</a></div></div>';
            }
            elseif($Basket->Status == 3 || $Basket->Status == 2){
                $data = $data . '<a href="javascript:boid(0)"  class="btn ripple btn-primary text-white disabled">سبد ارسال شده است</a></div></div>';
            }
        return $data;
}

function outofStock($Basket)
{
    $BasketsProducts = BasketsProducts::where('baskets_id', '=', $Basket->id)
    ->get();
    foreach($BasketsProducts as $BasketsProduct)
    {
        $Product = Products::where('is_Delete','=',0)
        ->where('id','=',$BasketsProduct->products_id)
        ->first();
        $ColorNumberPrice = ColorNumberPrice::where('products_id','=',$BasketsProduct->products_id)
        ->where('color_id','=',$BasketsProduct->color_id)
        ->first();
        $ColorNumberPrice->number = $ColorNumberPrice->number - $BasketsProduct->count;
        $ColorNumberPrice->update();
        SumNumber($Product);
    }
    
}

function checkBasket()
{
    $Basket = Baskets::where('user_id','=',Auth::user()->id)
    ->where('cancel','=','0')
    ->where('is_payed','=','0')
    ->where('is_Delete','=','0')
    ->first();
    $BasketsProducts = BasketsProducts::where('baskets_id','=',$Basket->id)
    ->where('is_Delete','=','0')
    ->where('count','>','0')
    ->get();
    foreach($BasketsProducts as $BasketsProduct)
    {
        if($BasketsProduct->Products()->SumNumber > 0)
        {
            if(count($BasketsProducts) > 0)
            {
                return true;
            }
            return false; 
        }
        return false; 
    }
    
}  
function getBasket()
{
    if(request()->is('admin/Baskets')){
        $data = Baskets::where('is_Delete','=',0)->get();
    }elseif(request()->is('admin/Baskets/paydone')){
        $data = Baskets::where('is_Delete','=',0)
        ->where('is_payed','=',1)
        ->get();
    }elseif(request()->is('admin/Baskets/cancel')){
        $data = Baskets::where('is_Delete','=',0)
        ->where('cancel','=',1)
        ->get();
    }elseif(request()->is('admin/Baskets/send')){
        $data = Baskets::where('is_Delete','=',0)
        ->where('send','=',1)
        ->get();
    }    
    if(request()->is('admin/Baskets'))
    {
        $Baskets = Baskets::where('is_Delete','=',0)
        ->get();
    }
    elseif(request()->is('admin/Baskets/paydone'))
    {
        $Baskets = Baskets::where('is_Delete','=',0)
        ->where('is_payed','=',1)
        ->get();
    }
    elseif(request()->is('admin/Baskets/cancel'))
    {
        $Baskets = Baskets::where('is_Delete','=',0)
        ->where('cancel','=',1)
        ->get();
    }
    elseif(request()->is('admin/Baskets/send'))
    {
        $Baskets = Baskets::where('is_Delete','=',0)
        ->where('send','=',1)
        ->get();
    }
    return $Baskets;
}
function createBasket($id)
{
    $Basket = new Baskets();
    $Basket->user_id = $id;
    $Basket->ordernumber = 'MSP-20000327'.random_int(100000,9999999);
    $Basket->Status = 0;
    $Basket->save();
}

function getBasketuser()
{
   return $Basket = Baskets::where('user_id','=',Auth::user()->id)
    ->where('cancel','=','0')
    ->where('is_payed','=','0')
    ->where('is_Delete','=','0')
    ->first();
}

function payedBasket($wallet)
{
    $Sum = SumBasket(bpu());
    $Basket =  getBasketuser();
    if($wallet->price >= $Sum)
    {
        $wallet->price = $wallet->price - $Sum ; 
        $wallet->update();
        $Basket->is_payed = 1;
        $Basket->Status = 1;
        $Basket->update();
        outofStock($Basket);
        createBasket(Auth::user()->id);
        createinvoice($Basket,$Sum);
        return redirect(route('BasketPayDone',['ordernumber' => $Basket->ordernumber]))->with('done','سبد شما با موفقیت پرداخت شد');
    }
}



// Get BasketsProducts
function GBP($ProductsBasket)
{
    if($ProductsBasket != null)
    {
        $Baskets =  '<div class="dropdownBasket"><a href="#">
            <span class="mdi mdi-shopping"></span>
            سبد خرید
            <span class="count count-ProducBasket">'.CPB($ProductsBasket).'</span>
        </a>
        <div class="dropdown-menu-cart">
        <div class="dropdown-header">
            <a href="#" class="view-cart">مشاهده سبد خرید</a>
        </div>
        <div class="wrapper">
            <div class="scrollbar" id="style-1">
                <div class="force-overflow">
                    <ul class="dropdown-list">
                        <a href="#">';
                        if($ProductsBasket != null){
                            foreach ($ProductsBasket as $ProducBasket){
                                if ($ProducBasket->count > 0 && $ProducBasket->is_Delete == 0){
                                    $Baskets = $Baskets . '<li class="dropdown-item ProductsBasket">
                                        <div class="title-cart">
                                            <img src="'.asset("images/Products-image/".$ProducBasket->Products()->img).'">
                                            <h3>'.$ProducBasket->Products()->title.'</h3>
                                            <span><b>رنگ : </b>'.$ProducBasket->Color()->Name.'</span><ion-icon style="top:.5rem;color:'.$ProducBasket->Color()->Color .'" name="radio-button-on-sharp"></ion-icon>
                                            <div class="price">'.number_format(ProductBasketPrice($ProducBasket) ).'<span>تومان</span></div>
                                            <div class="Count-span"><b>تعداد : </b>'.$ProducBasket->count.'</div>
                                        </div>
                                    </li>';
                                }
                            }
                        }
                        $Baskets = $Baskets . '</a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-dropdown">
            <div class="amount-total-buy">
                <div class="price">
                    <span class="total">مبلغ کل خرید :</span>
                    <span class="toman">'.number_format(SumBasket($ProductsBasket)).'
                        <span>تومان</span>
                    </span>
                </div>
            </div>
            <a href="'. route("BasketShow").'" class="checkout">ثبت سفارش</a>
        </div>
        </div></div>';

        return  $Baskets;
    }
}


function Card($ProductsBasket)
{
    if (checkBasket() == true)
    {
        $data = '<div class="container-main Basketpage">
            <div class="col-12">
                <div class="breadcrumb-container">
                    <ul class="js-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#" class="breadcrumb-link">خانه</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="breadcrumb-link active-breadcrumb">سبد خرید</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-content">
                <div class="cart-title-top">سبد خرید</div>
                <div class="cart-main">
                    <div class="col-lg-9 col-md-9 col-xs-12 pull-right">
                        <div class="title-content">
                            <ul class="title-ul">
                                <li class="title-item product-name">
                                    نام کالا
                                </li>
                                <li class="title-item required-number">
                                    تعداد
                                </li>
                                <li class="title-item unit-price">
                                    قیمت واحد
                                </li>
                                <li class="title-item total">
                                    مجموع
                                </li>
                            </ul>
                        </div>';
                        foreach ($ProductsBasket as $ProducBasket)
                        {
                            if ($ProducBasket->count > 0) 
                            {
                               $data = $data . '<div class="page-content-cart">
                                <div class="checkout-body">
                                    <div class="product-name before">
                                        <a href="javascript:void(0)" data-p-id="'.$ProducBasket->Products()->id.'" data-c-id="'.$ProducBasket->Color()->id.'" class="btn removeProduct">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </a>
                                        <a href="'.route("ShowProduct",["P_id" => $ProducBasket->Products()->P_id,"Color" => $ProducBasket->Color()->id ,"Name" =>$ProducBasket->Products()->Name]).'"class="col-thumb mt-4">
                                            <img src="'. asset("images/Products-image/". $ProducBasket->Products()->img).'">
                                        </a>
                                        <div class="checkout-col-desc">
                                            <a href="#">
                                                <h1>'.$ProducBasket->Products()->title.'</h1>
                                            </a>
                                            <div class="checkout-variant-color">
                                                <span class="checkout-variant-title">'.$ProducBasket->Color()->Name.'</span>
                                                <div class="checkout-variant-shape" style="background-color:'.$ProducBasket->Color()->Color.'"></div>
                                                <div class="checkout-guarantee"><i class="fa fa-check"></i>گارانتی ۱۸ ماهه</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="required-number before ProductNumber">
                                        <a data-p-id="'.$ProducBasket->Products()->id.'" data-c-id="'.$ProducBasket->Color()->id.'" class="btn btn-add-to-cart Pluscount';
                                        if(CountProductColor($ProducBasket,getColorNumber($ProducBasket->Products()->id,$ProducBasket->Color()->id)) == true)
                                        {
                                            $data = $data . ' disabled';
                                        }
                                        $data = $data .'">
                                            <ion-icon class="icone-ar" name="add-circle"></ion-icon>
                                        </a>
                                        <span id="countP" class="amount ms-5 count-size">'.$ProducBasket->count.'</span>
                                        <a data-p-id="'.$ProducBasket->Products()->id.'" data-c-id="'.$ProducBasket->Color()->id.'" class="btn btn-add-to-cart Minuscount">
                                            <ion-icon class="icone-ar" name="remove-circle"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="unit-price before">
                                        <div class="product-price">';
                                            if ($ProducBasket->Products()->Discounts())
                                            {
                                                $data =  $data . '<span class="amount ms-5">
                                                <del id="Price">'.number_format(Price($ProducBasket->Products()->id,$ProducBasket->Color()->id)).'</del>
                                                </span>
                                                <span id="Price-Discount" class="amount text-danger ml-3">
                                                    '.number_format(DiscountedPrice($ProducBasket->Products()->id,$ProducBasket->Color()->id)).'<span> تومان</span>
                                                </span>';
                                            }
                                            else
                                            {
                                                $data =  $data . '<span id="Price" class="amount text-danger ml-3">
                                                    '.number_format(DiscountedPrice($ProducBasket->Products()->id,$ProducBasket->Color()->id)).'<span> تومان</span>
                                                </span>';
                                            }
                                            
                                    $data =  $data . '</div>
                                    </div>
                                    <div class="total before">
                                        <div class="product-price">
                                            '.number_format(Sumrow($ProducBasket)).'<span>تومان</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            }
                        }
                    $data = $data . '</div>
                    <div class="col-lg-3 col-md-3 col-xs-12 pull-left">
                        <div class="page-aside">
                            <div class="checkout-summary">
                                <div class="comment-summary mb-3">
                                    <p>هزینه این سفارش هنوز پرداخت نشده‌ و در صورت اتمام موجودی، کالاها از سبد حذف می‌شوند</p>
                                </div>
                                <div class="discount-code mb-4">
                                    <form action="#" class="discount-form">
                                        <label for="discount">کد تخفیف</label>
                                        <input type="text" id="discount" class="input-discount" placeholder="کد تخفیف خود را وارد کنید">
                                        <a href="#">
                                            <button class="btn-discount">اعمال</button>
                                        </a>
                                    </form>
                                </div>
                                <div class="discount-code mb-2">
                                    <form action="#" class="discount-form">
                                        <label for="discount">کد هدیه</label>
                                        <input type="text" id="discount" class="input-discount" placeholder="کد هدیه خود را وارد کنید">
                                        <a href="#">
                                            <button class="btn-discount">اعمال</button>
                                        </a>
                                    </form>
                                </div>
                                <div class="amount-of-payable mt-4">
                                    <span class="payable">مبلغ قابل پرداخت</span>
                                    <span class="amount-of">'.number_format(SumBasket($ProductsBasket)).'<span>تومان</span></span>
                                    <a href="'.route('Addinfo').'">
                                        <button class="setlement-account">تسویه حساب</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        return $data;
        }
        else{
            $data = '<div class="container-main">
                <div class="col-12">
                    <div class="cart-page">
                        <div class="container">
                            <div class="checkout-empty">
                                <div class="checkout-empty-empty-cart-icon"></div>
                                <div class="checkout-empty-title">سبد خرید شما خالی است!</div>
                                <div class="col-lg-6 col-md-6!important col-xs-12 mx-auto">
                                    <div class="checkout-empty-links">
                                        <p>می‌توانید برای مشاهده محصولات بیشتر به صفحات زیر بروید</p>
                                        <div class="checkout-empty-link-urls">
                                            <a href="#">تخفیف‌ها و پیشنهادها</a>
                                            <a href="#">محصولات پرفروش روز</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            return $data;
        }
}

function StatusBakset($Basket)
{
    if($Basket->Status == 1){
        $Status = 'درحال پردازش سفارش';
    }elseif($Basket->Status == 2){
        $Status = 'خروج از انبار';
    }elseif($Basket->Status == 3){
        $Status = 'ارسال شده';
    }elseif($Basket->Status == 4){
        $Status = 'لغو شده';
    }
    return $Status;
}

function InvoiceBakset($Basket)
{
    return $data = invoice::where('baskets_id','=',$Basket->id)
    ->first();
}