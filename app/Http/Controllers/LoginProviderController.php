<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;

class LoginProviderController extends Controller
{
    public function redirect($Provider)
    {
        return Socialite::driver($Provider)->redirect();
    }

    public function callback($Provider)
    {
        try {
            $user = Socialite::driver($Provider)->user();
            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){
                return view('Home.Front.Auth.Completioninformation',[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'Id' => $user->getId(),
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }
            Auth::loginUsingId($saveUser->id);
            return redirect()->route('index');
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
    public function rigesterGoogle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => Rule::unique('users', 'mobile')
        ]);
        if ($validator->passes()) {
            $saveUser = User::updateOrCreate([
                'google_id' => $request->Id,
            ],[
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->name.'@'.$request->id),
                'mobile' => $request->mobile,
            ]);
            createBasket($saveUser->id);
            return redirect()->route('index');
        }
        return view('Home.Front.Auth.Completioninformation',[
            'name' => $request->name,
            'email' => $request->email,
            'Id' => $request->Id,
            'error' => $validator->errors()->all()
        ]);       
    }
}
