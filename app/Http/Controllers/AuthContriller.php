<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthContriller extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect(route('index'));
    }
}