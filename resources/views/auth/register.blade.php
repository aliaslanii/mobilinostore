@extends('Home.Layout.accounts')
@section('Content')



<section class="page-account-box">
    <div class="col-lg-5 col-md-5 col-xs-12 mx-auto">
        <div class="account-box" style="padding-bottom:40px;">
            <a href="#" class="account-box-logo">digistore</a>
            <div class="account-box-headline">
                <a href="{{ route('login') }}" class="login-ds">ورود</a>
                <a href="{{ route('register') }}" class="register-ds active-account">ثبت نام</a>
            </div>
            <div class="massege-light">ثبت نام تنها با شماره تلفن همراه امکان پذیر است.</div>
            <div class="account-box-content">
                <form class="form-account" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-account-title">
                        <label for="email-phone">نام شما : (اختیاری)</label>
                        <input type="text" class="number-email-input form-input" name="name" id="email-phone" placeholder=" نام خود را وارد نمایید">
                        <span class="mdi mdi-account-outline"></span>
                    </div>
                    <div class="form-account-title">
                        <label for="email-phone">ایمیل شما : (اختیاری)</label>
                        <input type="text" class="number-email-input form-input" name="email" id="email-phone" placeholder=" شماره موبایل خود را وارد نمایید">
                        <span class="mdi mdi-account-outline"></span>
                    </div>
                    <div class="form-account-title">
                        <label for="email-phone">شماره موبایل : </label>
                        <input type="text" class="number-email-input form-input" name="mobile" id="email-phone" placeholder=" شماره موبایل خود را وارد نمایید">
                        <span class="mdi mdi-account-outline"></span>
                    </div>
                    <div class="form-account-title">
                        <label for="password">کلمه عبور </label>
                        <input type="password" class="password-input form-input" name="password" placeholder="کلمه عبور خود را وارد نمایید">
                        <span class="mdi mdi-lock"></span>
                    </div>
                    <div class="form-account-title">
                        <label for="password">تکرار کلمه عبور  </label>
                        <input type="password" class="password-input form-input" name="password_confirmation" placeholder="کلمه عبور خود را وارد نمایید">
                        <span class="mdi mdi-lock"></span>
                    </div>
                    <div class="form-auth-row">
                        <label for="#" class="ui-checkbox">
                            <input type="checkbox" required id="remember">
                            <span class="ui-checkbox-check"></span>
                        </label>
                        <label for="remember" class="remember-me"><a href="#">حریم خصوصی</a> و <a href="#">شرایط قوانین</a>استفاده از سرویس های سایت دیجی‌اسمارت را مطالعه نموده و با کلیه موارد آن موافقم.</label>
                    </div>
                    <center>
                        <button type="submit" class="text-white btn active-account mb-3 w-100 mt-5">ثبت نام در موبایلینو</button>
                        <a class="text-white btn btn-danger  w-100" href="#">ورود با گوگل <ion-icon style="top : .4rem" name="logo-google"></ion-icon></a>
                    </center>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
