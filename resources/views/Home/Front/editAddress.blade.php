@extends('Home.Layout.Profile')
@section('Content')
    <div class="main-content login_content col-xl-9 col-lg-8 col-md-12 order-2 mx-auto">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <header class="card-header">
                    <h3 class="card-title"><span>ویرایش آدرس</span></h3>
                </header>
                <div class="login_box">
                    <form method="POST" action="{{ route('UpdatetAddress') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-account-title">استان<span>*</span></div>
                                <div class="form-account-row">
                                    <input class="input_second input_all" required name="State" type="text" value="{{ $Address->State }}" placeholder="مثال:تهران">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-account-title">شهر<span>*</span></div>
                                <div class="form-account-row">
                                    <input class="input_second input_all" required name="City" type="text" value="{{ $Address->City }}" placeholder="مثال:تهران">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-account-title"> آدرس<span>*</span></div>
                                <div class="form-account-row">
                                    <input class="input_second input_all" required name="Address" type="text" value="{{ $Address->Address }}" placeholder="مثال: خیابان امام، بعد میدان حشمت، نرسید به چهارراه میکائیل">
                                    <input name="id" type="hidden" value="{{ $Address->id }}">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn big_btn btn-main-masai">ویرایش آدرس</button>
                            </div>
                        </div>  
                    </form>               
                </div>
            </div>
        </div>
    </div>
@endsection


