<?php

namespace App\Http\Controllers;

use App\Http\Requests\passwordrequest;
use App\Models\FaveritProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeUserController extends Controller
{
    public function Profile()
    {
        return view('Home.Front.Profile');   
    }

    public function faveritProducts()
    {
        $FaveritProducts = FaveritProduct::where('user_id','=',Auth::user()->id)->get();
        return view('Home.Front.ProfileFaveritProducts',[
            'FaveritProducts' => $FaveritProducts
        ]);  
    }

    public function editProfile()
    {
        return view('Home.Front.editProfile'); 
    }
    public function insertProfile(Request $request)
    {
        $User = User::find(Auth::user()->id);
        $User->name = $request->name;
        $User->username = $request->username;
        $User->codemeli = $request->codemeli;
        $User->cardnumber = $request->cardnumber;
        $User->update();
        return redirect(route('Profile'));
    }
    public function updatepassword()
    {
        return view('auth.PasswordChange');
    }
    public function insertpassword(passwordrequest $request)
    {
       if(Hash::check($request->password_old,Auth::user()->password))
       {
            $request->validated();
            $User = User::find(Auth::user()->id);
            $User->password = Hash::make($request->password);
            $User->update();
            return redirect(route('Profile'))->with('updatedone','رمز عبور شما با موفقیت تغیر کرد');
       }
       else
       {
            return redirect()->back()->with('error','رمز عبور فعلی وارد شده اشتباه است');
       }
    }
}