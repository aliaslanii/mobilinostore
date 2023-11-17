@extends('Home.Layout.accounts')
@section('Content')
<section class="page-account-box mt-5">
    <div class="col-lg-5 col-md-5 col-xs-12 mx-auto">
        <div class="account-box">
            <a href="#" class="account-box-logo mb-5"></a>
            <div class="account-box-content" style="margin-top: 6rem">
                <form method="POST" action="{{ route('rigesterGoogle') }}" class="form-account">
                    @csrf
                    <div class="form-account-title">
                        <label for="email-phone">شماره موبایل</label>
                        <input type="text" class="number-email-input form-input" name="mobile" id="email-phone" placeholder="شماره موبایل خود را وارد نمایید">
                        <input type="hidden" value="{{ $name }}" name="name">
                        <input type="hidden" value="{{ $email }}" name="email">
                        <input type="hidden" value="{{ $Id }}" name="Id">
                        <span class="mdi mdi-account-outline"></span>
                    </div>
                    <center>
                        <button type="submit" class="text-white btn active-account mb-3 w-100 mt-5">ثبت اطلاعات</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection