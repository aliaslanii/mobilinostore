@extends('Home.Layout.accounts')
@section('Content')
<div class="container-main">
    <div class="col-12">
        <div class="semi-modal-layout">
            <section class="page-account-box">
                <div class="col-lg-7 col-md-7 col-xs-12 mx-auto">
                    <div class="account-box">
                        <a href="#" class="account-box-logo">digistore</a>
                        <div class="account-box-headline remembers-passwords">
                            تغییر رمز عبور
                        </div>
                        <div class="account-box-content">
                            <form class="form-account" action="{{ route('insertpassword') }}" method="POST">
                                @csrf
                                <div class="form-account-title">
                                    <div class="form-account-title">
                                        <label for="password">رمز عبور قبلی</label>
                                        <input type="password" name="password_old" class="password-input" placeholder="رمز عبور خود را وارد نمایید">
                                        <span class="mdi mdi-lock"></span>
                                    </div>
                                </div>
                                <div class="form-account-title">
                                    <div class="form-account-title">
                                        <label for="password">رمز عبور جدید</label>
                                        <input type="password" name="password" class="password-input" placeholder="رمز عبور خود را وارد نمایید">
                                        <span class="mdi mdi-lock"></span>
                                    </div>
                                </div>
                                <div class="form-account-title">
                                    <div class="form-account-title">
                                        <label for="password">تکرار رمز عبور جدید</label>
                                        <input type="password"  name="password_confirmation" class="password-input" placeholder="رمز عبور خود را وارد نمایید">
                                        <span class="mdi mdi-lock"></span>
                                    </div>
                                </div>
                                <div class="parent-btn">
                                    <button class="dk-btn dk-btn-info">
                                            تغییر رمز عبور
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection