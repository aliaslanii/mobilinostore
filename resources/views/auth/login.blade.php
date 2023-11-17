@extends('Home.Layout.accounts')
@section('Content')
<section class="page-account-box">
    <div class="col-lg-5 col-md-5 col-xs-12 mx-auto">
        <div class="account-box">
            <a href="#" class="account-box-logo"></a>
            <div class="account-box-headline">
                <a href="#" class="login-ds active-account">ورود</a>
                <a href="{{ route('register') }}" class="register-ds">ثبت نام</a>
            </div>
            <div class="account-box-content">
                <form method="POST" action="{{ route('login') }}" class="form-account">
                        @csrf
                    <div class="form-account-title">
                        <label for="email-phone">شماره موبایل</label>
                        <input type="text" class="number-email-input form-input" name="mobile" id="email-phone" placeholder="شماره موبایل خود را وارد نمایید">
                        <span class="mdi mdi-account-outline"></span>
                    </div>
                    <div class="form-account-title">
                        <label for="password">رمز عبور</label>
                        <input type="password" class="password-input form-input" name="password" placeholder="رمز عبور خود را وارد نمایید">
                        <span class="mdi mdi-lock"></span>
                    </div>
                    <div class="form-auth-row">
                        <label for="#" class="ui-checkbox">
                            <input type="checkbox" name="remember" name="login" checked="" id="remember">
                            <span class="ui-checkbox-check"></span>
                        </label>
                        <label for="remember" class="remember-me">مرا به خاطر داشته باش</label>
                    </div>
                    <center>
                        <button type="submit" class="text-white btn active-account mb-3 w-100 mt-5">ورود به موبالینو</button>
                        <a class="text-white btn btn-danger mb-3 w-100" href="{{ route('redirect',['Provider' => 'google']) }}">ورود با گوگل <ion-icon style="top : .4rem" name="logo-google"></ion-icon></a>
                        <a class="text-white btn btn-dark w-100" href="{{ route('redirect',['Provider' => 'github']) }}">ورود با گیت هاب <ion-icon style="top : .4rem" name="logo-github"></ion-icon></a>
                    </center>
                    <div class="forget-password">
                        <a href="#" class="account-link-password">رمز خود را فراموش کرده ام</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection