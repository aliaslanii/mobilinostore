@extends('Home.Layout.Home')
@section('Content')
<main class="wrapper default ">
    <div class="container">
        <div class="row">
            <div class="main-content login_content  col-12 col-md-7 col-lg-5 mx-auto">
                <header class="card-header">
                    <h3 class="card-title"><span>بازنشانی کلمه عبور</span></h3>
                </header>
                <div class="login_box">
                    <form action="{{ route('insertpassword') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-account-title"><span>*</span> کلمه عبور فعلی </div>
                                <div class="form-account-row">
                                    <input class="input_second input_all" name="password_old" type="text" placeholder="کلمه عبور حداقل باید 8 کارکتر باشد">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-account-title"><span>*</span> کلمه عبور جدید </div>
                                <div class="form-account-row">
                                    <input class="input_second input_all" type="text" name="password" placeholder="کلمه عبور حداقل باید 8 کارکتر باشد">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-account-title"><span>*</span> تکرار کلمه عبور</div>
                                <div class="form-account-row">
                                    <input class="input_second input_all" name="password_confirmation" type="password" placeholder=" تکرار کلمه عبور جدید">
                                </div>
                            </div>
                            <div class="col-12 text--center">
                                <button type="submit" class="btn big_btn btn-main-masai">بازنشانی کلمه عبور </button>
                            </div>
                            <div class="col-12 text--center">
                                <a href="{{ route('Profile') }}" class="btn big_btn btn-main-masai">بازگشت</a>
                            </div>
                            <div class="col-12 footer_login_reg text--center">
                                <p>
                                    رمز عبور خود را محافظت کرده و از افشای آن به دیگران خودداری کنید، همچنین از استفاده از رمزهای ضعیف و قابل پیش‌بینی جلوگیری کنید.
                                </p>

                            </div>
                            <div class="col-12 ">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
</main>
@endsection