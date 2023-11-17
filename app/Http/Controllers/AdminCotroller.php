<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminCotroller extends Controller
{
    public function index()
    {
        return view('Admin.Front.index');
    }
    public function adminProfile()
    {
        return view('Admin.Front.Profile.Profile');
    }
    public function adminProfileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => Rule::unique('users', 'email')->ignore(Auth::user()->id),
            'mobile' => Rule::unique('users', 'mobile')->ignore(Auth::user()->id),
        ]);
        if ($validator->passes()) {
            $User = User::find(Auth::user()->id);
            $User->name = $request->name;
            $User->username = $request->username;
            $User->email = $request->email;
            $User->mobile = $request->mobile;
            $User->update();
            return response()->json($User);
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
    public function adminProfileUpdateimg(Request $request)
    {
        $request->validate([
            'img' => 'required|mimes:png,jpg|max:2000', 
        ]);
        $path = 'images/User-image/';
        $User = User::find(Auth::user()->id);
        $User->img = moveimg($request,$path);
        $User->update();
        return redirect()->back();
    }
}
