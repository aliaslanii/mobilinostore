<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <title>فروشگاه اینترنتی موبالینو</title>
    <!--    font------------------------------------>
    <link rel="stylesheet" href="{{ load('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ load('assets/css/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ load('assets/css/materialdesignicons.css.map') }}">
    <!--    bootstrap------------------------------->
    <link rel="stylesheet" href="{{ load('assets/css/bootstrap.css') }}">
    <!--    owl.carousel---------------------------->
    <link rel="stylesheet" href="{{ load('assets/css/owl.carousel.min.css') }}">
    <!-- sweetalert2-------------------------------->
    <link rel="stylesheet" href="{{ load('assets/css/sweetalert2.min.css') }}">
    <!--    responsive------------------------------>
    <link rel="stylesheet" href="{{ load('assets/css/responsive.css') }}">
    <!--    main style------------------------------>
    <link rel="stylesheet" href="{{ load('assets/css/main.css') }}">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <!--page-login-------------------------->
    <div class="container-main">
        <div class="col-12">
            <div class="semi-modal-layout">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div dir="rtl" style="margin-top: .2rem;" class="row er">            
                            <div class="alert alert-danger alert-dismissible fade show col-md-4 mt-4">
                            <strong>@lang('validation-attributes.alert')</strong><span>{{ $error }}</span>
                            <ion-icon class="btn-close" name="close-sharp"></ion-icon>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if ( Session::get('error') )
                <div dir="rtl" style="margin-top: .2rem;" class="row er">            
                    <div class="alert alert-danger alert-dismissible fade show col-md-4 mt-4">
                    <strong>@lang('validation-attributes.alert')</strong><span>{{ Session::get('error')}}</span>
                    <ion-icon class="btn-close" name="close-sharp"></ion-icon>
                    </div>
                </div>
                @endif
                @yield('Content')
                <footer class="footer-light">
                    <div class="container">
                        <ul class="footer-light-link">
                            <li><a href="#">درباره موبالینو</a></li>
                            <li><a href="#">فرصت‌های شغلی</a></li>
                            <li><a href="#">تماس با ما</a></li>
                            <li><a href="#">همکاری با سازمان‌ها</a></li>
                        </ul>

                        <p class="title-footer">استفاده از مطالب فروشگاه اینترنتی موبالینو فقط برای مقاصد غیرتجاری و
                            با ذکر منبع
                            بلامانع است. کلیه حقوق این سایت متعلق به شرکت نوآوران فن آوازه (فروشگاه آنلاین موبالینو)
                            می‌باشد.</p>

                        <p class="copy-right-footer-light">Copyright © 2006 - 2019 DigiSmart.com</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!--page-login-------------------------->
</body>
<!--jquery--------------------------------------->
<script src="{{ load('assets/js/jquery-3.2.1.min.js') }}"></script>
<!--    bootstrap-------------------------------->
<script src="{{ load('assets/js/bootstrap.js') }}"></script>
<!--    owl.carousel----------------------------->
<script src="{{ load('assets/js/owl.carousel.min.js') }}"></script>
<!--main----------------------------------------->
<script src="{{ load('assets/js/main.js') }}"></script>
</html>