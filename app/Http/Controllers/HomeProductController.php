<?php

namespace App\Http\Controllers;

use App\Models\ColorNumberPrice;
use App\Models\comments;
use App\Models\Comments_minus;
use App\Models\Comments_plus;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeProductController extends Controller
{
    public function showProduct($P_id,$Name,$Color)
    {   
        $Product = Products::where('is_Delete','=',0)
        ->where('P_id','=',$P_id)
        ->first();
        $Product->favorite = $Product->favorite + 1;
        $Product->update();
        $Products = Products::where('is_Delete','=','0')
        ->where('SumNumber','>',0)
        ->where('categories_id','=',$Product->categories_id)
        ->take(12)
        ->get();
        $ColorNumberPrice = ColorNumberPrice::where('products_id','=',$Product->id)
        ->where('color_id','=',$Color)
        ->first();
        $Comments = comments::where('product_id','=',$Product->id)
        ->where('accept','=',1)
        ->get();
        $fpb = fpb($Product->id,$Color);
        return view('Home.Front.ShowProduct',[
            'Product' => $Product,
            'Color' =>  $Color,
            'ColorNumberPrice' => $ColorNumberPrice,
            'Comments' => $Comments,
            'fpb' => $fpb,
            'Products' => $Products
        ]);
    }
    public function SelectColor(Request $request)
    {   
        $Product = Products::where('is_Delete','=',0)
        ->where('id','=',$request->Product)
        ->first();
        $ColorNumberPrice = ColorNumberPrice::where('products_id','=',$request->Product)
        ->where('color_id','=',$request->Color)
        ->first();
        if(fpb($Product->id,$request->Color) != null){
            $count = fpb($Product->id,$request->Color)->count;
        }else{
            $count = 0;
        }
        $Price = $ColorNumberPrice->price;
        if($Product->Discounts()){
            $PriceDiscount = $Price - ($Price *( $Product->Discounts()->Discount_number / 100));
        }else{
            $PriceDiscount = null; 
        }
        return response()->json(['count' => $count,'Price' => $Price,'PriceDiscount' => $PriceDiscount,'Color' =>  $ColorNumberPrice->color_id,'error' => CBU($Product->id,$ColorNumberPrice->color_id)]);
    }

    public function commentProduct($P_id)
    {   
        $Product = Products::where('is_Delete','=',0)
        ->where('P_id','=',$P_id)
        ->first();
        return view('Home.Front.CommentProduct',[
            'Product' => $Product,
        ]);
    }
    public function AddPointplus(Request $request)
    {   
        return response()->json(['data' => addPointplus($request->point)]);    
    }

    public function AddPointminus(Request $request)
    {   
        return response()->json(['data' => addPointminus($request->point)]);
    }

    public function insertCommentProduct(Request $request)
    {   
        if(Auth::user())
        {
            $Product = Products::where('is_Delete','=',0)
            ->where('id','=',$request->Product)
            ->first();
            $Comment = new comments();
            $Comment->Subject = $request->Subject;
            $Comment->Viewpoint = $request->Viewpoint;
            $Comment->Description = $request->Description;
            $Comment->user_id = Auth::user()->id;
            $Comment->product_id = $Product->id;
            $Comment->save();
            foreach($request->plus as $pluse)
            {
                $plus = new Comments_plus();
                $plus->plus = $pluse;
                $plus->comments_id = $Comment->id;
                $plus->save();
            }
            foreach($request->minus as $minu)
            {
                $minus = new Comments_minus();
                $minus->minus = $minu;
                $minus->comments_id = $Comment->id;
                $minus->save();
            }
            return response()->json('done');
        }
        
    } 
}