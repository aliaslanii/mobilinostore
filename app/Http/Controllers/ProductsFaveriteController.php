<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\FaveritProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsFaveriteController extends Controller
{
    public function addFavirate(Request $request)
    {
        $FaveritProduct = new FaveritProduct();
        $FaveritProduct->products_id = $request->product_id;
        $FaveritProduct->user_id = Auth::user()->id;
        $FaveritProduct->save();
        return response()->json(['success'=> 'FaveritProduct add successfully.']);
    }
    public function removeFavirate(Request $request)
    {
        $FaveritProduct = FaveritProduct::where('products_id','=',$request->product_id)
        ->where('user_id','=',Auth::user()->id)
        ->where('is_Delete','=',0)
        ->first();
        $FaveritProduct->delete();
        return response()->json(['FPL' => FPL()]);
        
    }
}
