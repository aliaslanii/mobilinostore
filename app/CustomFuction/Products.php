<?php

use App\Models\Baskets;
use App\Models\BasketsProducts;
use App\Models\ColorNumberPrice;
use App\Models\Colors;
use App\Models\Discount;
use App\Models\FaveritProduct;
use App\Models\Images;
use App\Models\Products;
use App\Models\SpecificationProducts;
use App\Models\Suggestion;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

function getProperty($request)
{
    foreach($request as $value)
    {
        if($value!=null)
        {
            $Property[] = $value;
        }
        else{
            $Property = null;
            return $Property;
        }
    }
    return $Property;
}

function getValue($request)
{
    foreach($request as $valuee)
    {
        if($valuee!=null)
        {
            $value[] = $valuee;
        }
        else{
            $value = null;
            return $value;
        }
    }
    return $value;
}

function insertid($Product)
{
    $Product->P_id = 'MSP-'.$Product->id;
    $Product->update();
}

// insert Specification Property value
function insertSPV($request,$Product)
{
    if($request->Property!=null)
    {
        if($request->value!=null)
        {
            if(getProperty($request->Property)!=null)
            {
                if(getValue($request->value)!=null)
                {
                    foreach(array_combine(getProperty($request->Property),getValue($request->value)) as $Property => $value)
                    {
                        $specification = new SpecificationProducts();
                        $specification->products_id = $Product->id;
                        $specification->Property = $Property;
                        $specification->value = $value;
                        $specification->save();
                            
                    }
                }
            }
        }
    } 
}

function SumNumber($Product)
{
    $SumNumber = 0 ;
    $ColorsNumberPrice = ColorNumberPrice::where('products_id','=',$Product->id)
    ->get();
    foreach($ColorsNumberPrice as $ColorNumberPrice)
    {
        $SumNumber += $ColorNumberPrice->number;
    }
    $P = Products::where('id','=',$Product->id)->first();
    $P->SumNumber = $SumNumber;
    $P->update();
}

function CheapestPrice($Product)
{
    $ColorNumberPrice = ColorNumberPrice::where('products_id','=',$Product->id)
    ->where('number','>',0)
    ->orderBy('price','asc')
    ->first();
    return $ColorNumberPrice->price;
}

// insert images Product
function insertimgs($request,$TempFiles,$Product)
{
    if($request->imgs)
    {
        foreach($request->imgs as $img)
        {
            foreach($TempFiles as $TempFile)
            {
                if($img == $TempFile->Folder)
                {
                    $img = $TempFile->File;
                    File::copy(storage_path('app/public/images/temp/' . $TempFile->Folder . '/'. $TempFile->File),'images/Products-image/'.$TempFile->File);
                    $imgs = new Images();
                    $imgs->img = $img;
                    $imgs->products_id = $Product->id;
                    $imgs->save();
                    Storage::deleteDirectory('images/temp/'.$TempFile->Folder);
                    $TempFile->delete();
                }
            }
        }
    }
}

// deleteimg Product
function deleteimgP($img)
{
    if($img != null)
    {
        File::delete('images/Products-image/'.$img->img);
        $img->delete();
        return response()->json(['success' => 'تصویر با موفقیت حذف شد','images' => getImages($img->Products())]);
    }
    elseif($img == null)
    {
        return response()->json(['error' => 'تصویر پیدا نشد مجدد تلاش کنید']);
    }
}

function getImages($Product)
{
    $img = '';
    foreach ($Product->Images() as $Image)
    {
        $img = $img . '<div class="col-6 col-md-3 Products-image img-old">
            <a href="javascript:void(0)" data-id="'. $Image->id .'" class="btnDeleteimg mt-1"><ion-icon class="btnDeleteimg-icon" name="close-circle-outline"></ion-icon></a>
            <img alt="تصویر محصول" class="img-thumbnail" src="'.asset("images/Products-image/".$Image->img).'">
        </div>';
    }
    return $img;
}

function DeleteoldCPN($Product)
{
    $ColorsNumbersPrices = ColorNumberPrice::where('products_id','=',$Product->id)->get();
    foreach($ColorsNumbersPrices as $ColorNumberPrice)
    {
        $ColorNumberPrice->delete();
    }
}

function DeleteoldSpecification($Product)
{
 $Specification = SpecificationProducts::where('products_id','=',$Product->id)->get();
    foreach($Specification as $Specificat)
    {
        if($Specificat->products_id == $Product->id)
        {
            $Specificat->delete();
        }
    }
}
// delete move insert img
function dmiimgProduct($request,$path,$Product)
{
    if($request->img)
    {
        $extension =$request->img->extension();
        $img = verta()->format('Ymd-hms')."-".random_int(100000, 999999).".".$extension;
        $request->img->move(public_path($path),$img);
        File::delete('asset-Admin/images/Products-image/'.$Product->img);
        return $img;
    }
    else
    {
        return $Product->img;
    }
}
function getfp($Product,$user)
{
    $FaveritProduct = FaveritProduct::where('products_id','=',$Product->id)
    ->where('user_id','=',$user->id)
    ->first();
    if($FaveritProduct != null)
    {
        return $FaveritProduct->id;
    }
}
function Price($Product,$Color)
{
    $ColorNumberPrice = ColorNumberPrice::where('products_id','=',$Product)
    ->where('color_id','=',$Color)
    ->first();
    return $ColorNumberPrice->price;
}
function DiscountedPrice($Product,$Color)
{
    $Price = Price($Product,$Color);
    $Product = Products::where('id','=',$Product)
    ->first();
    if(CheckDiscount($Product)){
        return $data = $Price -  $Price * ($Product->Discounts()->Discount_number/100);
    }else{
        return $data = $Price;
    }   
}

//  found Product Baskets
function fpb($Product,$Color)
{
    if(Auth::user())
    {
        $Basket = Baskets::where('user_id', '=',Auth::user()->id)
        ->where('cancel', '=', '0')
        ->where('is_payed', '=', '0')
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProducts = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('products_id','=',$Product)
        ->where('color_id','=',$Color)
        ->where('count','!=',0)
        ->first();
        if($BasketsProducts)
        {
            return $BasketsProducts;
        }else{
            return null;
        }
    }
    else{
        return null;
    }
}
// check Faverit Product 
function checkfp($Product)
{
    if(Auth::user())
    {
        $FaveritProduct = FaveritProduct::where('products_id','=',$Product)
        ->where('user_id','=',Auth::user()->id)
        ->first();
        if($FaveritProduct){
            return true;
        }else{
            return false;
        }
    }
}

// Color Number Price
function CNP($Product)
{
    $i = 1;
    $data = '<div id="table-CPN-Product" class="table dataTable"><table class="table text-nowrap text-md-nowrap mg-b-0">
    <tr><th>#</th><th>رنگ</th><th>قیمت</th><th>تعداد</th></tr>';
    foreach($Product->ColorNumberPrice() as $ColorNumberPrice)
    {
        $data = $data . '<tr>
        <td>'.$i.'</td>
        <td><span class="colorinput-color border" style="background-color:'.$ColorNumberPrice->Color()->Color.'"></span></label></td>
        <td>'.$ColorNumberPrice->price.'</td><td>'.$ColorNumberPrice->number.'</td></tr>';
        $i++;
    }
    $data = $data .'</table></div>';
    return $data;
}

// Colors set input
function CSI($request)
{
    $i = 1 ;
    $SCPN = '';
    if($request->Colors != null)
    {
        foreach($request->Colors as $Colors)
        {
            $Color = Colors::find($Colors);
            $SCPN = $SCPN . '<div class="row row-sm CPN-inputs mt-3">
                <div class="col-lg-1">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="main-content-label mt-2">'.$i.'</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <input name="Colors[]" value="'.$Color->id.'" type="hidden">
                            <span style="background-color:'.$Color->Color.'" class="colorinput-color border"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">قیمت : </span>
                        </div>
                        <input name="Prices[]" class="form-control required" placeholder="قیمت رنگ '.$Color->Name.'" type="text">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">تعداد : </span>
                        </div>
                        <input name="Numbers[]" maxlength="3" class="form-control required" placeholder="تعداد رنگ '.$Color->Name.'" type="text">
                    </div>
                </div>
            </div>';    
            $i++;         
        }
    }
    else
    {
        $SCPN = false;
    }
    return $SCPN;
}
// Update Colors set input
function UCSI($request)
{
    $i = 1 ;
    $SCPN = '';
    $Product = Products::find($request->id);
    if($request->Colors != null)
    {
        foreach($request->Colors as $Colors)
        {
            $Color = Colors::find($Colors);
            $SCPN = $SCPN . '<div class="row row-sm CPN-inputs mt-3">
                <div class="col-lg-1">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="main-content-label mt-2">'.$i.' -</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <input name="Colors[]" value="'.$Color->id.'" type="hidden">
                            <span style="background-color:'.$Color->Color.'" class="colorinput-color border"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">قیمت : </span>
                        </div>
                        <input name="Prices[]" class="form-control required"';
                        foreach($Product->ColorNumberPrice() as $PColor)
                        {
                            if($PColor->color_id == $Color->id)
                            {
                                $SCPN = $SCPN . 'value="'.$PColor->price.'"';
                            }
                        }
                        $SCPN = $SCPN . 'placeholder="قیمت رنگ '.$Color->Name.'" type="text">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">تعداد : </span>
                        </div>
                        <input name="Numbers[]" maxlength="3" class="form-control required"';
                        foreach($Product->ColorNumberPrice() as $PNumber)
                        {
                            if($PNumber->color_id == $Color->id)
                            {
                                $SCPN = $SCPN . 'value="'.$PNumber->number.'"';
                            }
                        }
                        $SCPN = $SCPN . 'placeholder="تعداد رنگ '.$Color->Name.'" type="text">
                    </div>
                </div>
            </div>';    
            $i++;         
        }
    }
    else
    {
        $SCPN = false;
    }
    return $SCPN;
}

// Product Show card
function PSC($Product,$Discount)
{
    $value = '<div class="card custom-card Product-show-accept"><div class="p-0 ht-100p"><div class="product-grid"><div class="product-image">
    <a href="#" class="image"><img class="pic-1" alt="محصول-تصویر-1" src="'.asset("images/Products-image/".$Product->img).'"></a>';
    if($Discount != false)
    {
        $value =  $value . '<span class="product-discount-label bg-danger">-'.$Discount->Discount_number.'%</span>';	
    }
    $value =  $value .'</div><div class="product-content"><h3 id="title-Product"><a href="#">'.$Product->title.'</a></h3><div class="price">';
    if($Discount != false)
    {
        $value =  $value . '<span class="old-price">'.number_format(CheapestPrice($Product)).' تومان </span>
        <span class="text-danger">'.number_format(CheapestPrice($Product) - (CheapestPrice($Product) * $Discount->Discount_number /100)).'</span>';
    }else{
        $value =  $value . '<span class="text-danger">'.number_format(CheapestPrice($Product)).' تومان</span>';
    }
    $value =  $value .'</div>';
    foreach($Product->ColorNumberPrice() as  $Color)
    {
        $value = $value . '<label class="colorinput"><input class="colorinput-input">
        <span class="colorinput-color border" style="background-color:'.$Color->Color()->Color.'"></span></label>';
    }
    $value = $value . '</div></div></div></div>';
    return $value ;
}


// Discount suggested Product
function DSP($Product,$request)
{
    $Discounts = $Product->Discounts();
    $Suggestions = $Product->Suggestions();
    if($Discounts != null)
    {
        $Discounts->is_Delete = true;
        $Discounts->update();
    }
    if($Suggestions != null)
    {
        $Suggestions->is_Delete = true;
        $Suggestions->update();
    }
    if($request->Discount == 1)
    {
        $Discount = new Discount();
        $Discount->Discount_number = $request->Discount_number;
        $Discount->StartTime = Verta::parse($request->StartDiscount)->datetime()->format('Y/m/d');
        $Discount->EndTime = Verta::parse($request->EndDiscount)->datetime()->format('Y/m/d');
        $Discount->save();
        $Product->discounts_id = $Discount->id;
    }else{
        $Discount = false;
        $Product->discounts_id = null;
    }
    if($request->suggested == 1)
    {
        $suggested = new Suggestion();
        $suggested->suggestion = true;
        $suggested->StartTime = Verta::parse($request->Startsuggested)->datetime()->format('Y/m/d');
        $suggested->EndTime = Verta::parse($request->Endsuggested)->datetime()->format('Y/m/d');
        $suggested->save();
        $Product->suggestions_id = $suggested->id;
    }
    else{
        $Product->suggestions_id = null;
    }
    $Product->update();
    return $Discount;
}


//Count Products Basket
function CPB($ProductsBasket)
{
    $Count = 0;
    if($ProductsBasket != null)
    {
        foreach ($ProductsBasket as $ProducBasket)
        {
            if ($ProducBasket->count > 0)
            {
                if ($ProducBasket->Products()->SumNumber > 0)
                {
                    $Count ++;
                }
            }
        }
    } 
    return $Count;             
}

function Paginator_Products($data)
{
    if($data!=null)
    {
        $perPage = 10;
        $page = request()->get('page', 1);
        $dataCollection = collect($data);
        $dataCollection = $dataCollection->slice(($page - 1) * $perPage, $perPage);
        return $Products = new Paginator($dataCollection, $perPage, $page); 
    }        
}

function getColorNumber($Product,$Color)
{
    return $data = ColorNumberPrice::where('color_id', '=', $Color)
    ->where('products_id', '=', $Product)
    ->first();
}

function CountProductColor($BasketsProduct,$ColorNumber)
{
    if($BasketsProduct->count < $ColorNumber->number){
        return false;
    }elseif($BasketsProduct->count ==  $ColorNumber->number){
        return true;
    }
}
// get Count Basket User
function CBU($Product,$Color)
{
   if(Auth::user())
   {
        $Basket = Baskets::where('user_id', '=',Auth::user()->id)
        ->where('cancel', '=', '0')
        ->where('is_payed', '=', '0')
        ->where('is_Delete', '=', '0')
        ->first();
        $BasketsProduct = BasketsProducts::where('baskets_id', '=', $Basket->id)
        ->where('products_id', '=', $Product)
        ->where('color_id', '=', $Color)
        ->where('is_Delete', '=', '0')
        ->first();
        $ColorNumberPrice = ColorNumberPrice::where('color_id', '=', $Color)
        ->where('products_id', '=', $Product)
        ->first();
        if($BasketsProduct )
        {
            if($BasketsProduct->count < $ColorNumberPrice->number){
                return false;
            }elseif($BasketsProduct->count ==  $ColorNumberPrice->number){
                return true;
            }
        }else{
            if($ColorNumberPrice->number > 1)
            {
                return false;
            } else{
                return true;
            }
        }
   }
   else
    {
        $ColorNumberPrice = ColorNumberPrice::where('color_id', '=', $Color)
        ->where('products_id', '=', $Product)
        ->first();
        if($ColorNumberPrice->number > 1)
        {
            return false;
        } else{
            return true;
        }
    }
}

function CheckDiscount($Product)
{
    $Product = Products::find($Product->id); 
    if($Product->Discounts())
    { 
        $nowtime = Carbon::now();
        $StartTime = Carbon::parse($Product->Discounts()->StartTime);
        $EndTime = Carbon::parse($Product->Discounts()->EndTime);
       if($nowtime->gte($StartTime) == true && $nowtime->gte($EndTime ) == false)
       {
            return true;   
       }
       else{
            return false;
       }
    }
    else{
        return false;
    }
}

function CheckSuggestions($Product)
{
    $Product = Products::find($Product->id); 
    if($Product->Suggestions())
    { 
        $nowtime = Carbon::now();
        $StartTime = Carbon::parse($Product->Suggestions()->StartTime);
        $EndTime = Carbon::parse($Product->Suggestions()->EndTime);
       if($nowtime->gte($StartTime) == true && $nowtime->gte($EndTime ) == false)
       {
            return true;   
       }
       else{
            return false;
       }
    }
    else{
        return false;
    }
}