<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $Products = Products::where('is_Delete','=','0')
        ->where('SumNumber','>',0)
        ->orderBy('favorite','desc')
        ->take(15)
        ->get();  
        $newProducts = Products::where('is_Delete','=','0')
        ->where('SumNumber','>',0)
        ->orderBy('created_at','desc')
        ->take(15)
        ->get();  
        $SsuggestionsProduct = Products::where('is_Delete','=','0')
        ->where('SumNumber','>',0)
        ->where('suggestions_id','!=',null)
        ->orderBy('favorite','desc')
        ->take(9)
        ->get();
        return view('Home.Front.index',[
            'Products' => $Products,
            'SsuggestionsProduct' => $SsuggestionsProduct,
            'newProducts' => $newProducts
        ]);
    }
    public function about()
    {
        return view('Home.Front.about');
    }
    public function ContactUs()
    {
        return view('Home.Front.ContactUs');
    }
    public function ContactUsSend(Request $request)
    {
        $ContactUs = new ContactUs();
        $ContactUs->Name = $request->Name;
        $ContactUs->mobile = $request->mobile;
        $ContactUs->message = $request->message;
        $ContactUs->sms = $request->sms ?? 0;
        $ContactUs->save();
        return redirect(route('index'))->with('messagesend','پیام شما برای ما ارسال شد همکاران ما در اسرع وقت با شما تماس خواهند گرفت');
    } 
}