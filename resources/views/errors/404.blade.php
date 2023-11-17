@extends('Home.Layout.Home')
@section('Content') 
<!--404---------------------------------------->
        <div class="container-main">
            <div class="col-12">
                <div id="content">
                    <div class="d-404">
                        <div class="d-404-title">
                            <h1>صفحه‌ای که دنبال آن بودید پیدا نشد!</h1>
                        </div>
                        <div class="d-404-actions">
                            <a href="{{ route('index') }}" class="d-404-action-primary">صفحه اصلی</a>
                        </div>
                        <div class="d-404-image">
                            <img src="{{ asset('images/404/404.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--404---------------------------------------->
@endsection