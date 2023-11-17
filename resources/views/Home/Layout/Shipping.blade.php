<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <title>فروشگاه اینترنتی موبالینو</title>
    <!--    font------------------------------------>
    <link rel="stylesheet" href="{{ load('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ load('assets/css/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ load('assets/css/materialdesignicons.css.map') }}">
    <!--    bootstrap------------------------------->
    <link rel="stylesheet" href="{{ load('assets/css/bootstrap.css') }}">
    <!--    responsive------------------------------>
    <link rel="stylesheet" href="{{ load('assets/css/responsive.css') }}">
    <!--    main style------------------------------>
    <link rel="stylesheet" href="{{ load('assets/css/main.css') }}">
    @yield('link')
</head>

<body>
    <!-- Loader -->
    <div class="loader-div">
        <div class="page-loader"></div>
    </div>
    <!-- End Loader -->
    <!--header------------------------------------->
    <header class="js-header">
        <div class="container">
            <div class="header-row">
                <div class="header-logo">
                    <a href="" class="header-logo-img"></a>
                </div>
                @if (request()->is('Basket/Add/info'))
                <div class="shipment-page">
                    <ul class="checkout-steps">
                        <li class="is-completed">
                            <a href="#" class="checkout-steps-item-link active-link-shopping">
                                <span>اطلاعات ارسال</span>
                            </a>
                        </li>
                        <li class="is-completed">
                            <a href="#" class="checkout-steps-item active-link active-link-shopping">
                                <span>پرداخت</span>
                            </a>
                        </li>
                        <li class="is-active">
                            <a href="#" class="checkout-steps-item active-link">
                                <span>اتمام خرید و ارسال</span>
                            </a>
                        </li>
                    </ul>
                </div>
                @elseif (request()->is('Basket/Payment'))
                <div class="shipment-page">
                    <ul class="checkout-steps">
                        <li class="is-completed is-completed-active">
                            <a href="shopping.html" class="checkout-steps-item-link active-link-shopping">
                                <span>اطلاعات ارسال</span>
                            </a>
                        </li>
                        <li class="is-completed">
                            <a href="shopping-payment.html" class="checkout-steps-item-link active-link-shopping">
                                <span>پرداخت</span>
                            </a>
                        </li>
                        <li class="is-active">
                            <a href="shopping-complate-buy.html" class="checkout-steps-item active-link">
                                <span>اتمام خرید و ارسال</span>
                            </a>
                        </li>
                    </ul>
                </div>
                @elseif (request()->is('Basket/Pay/Done/*'))
                <div class="shipment-page">
                    <ul class="checkout-steps">
                        <li class="is-completed is-completed-active">
                            <a href="shopping.html" class="checkout-steps-item-link active-link-shopping">
                                <span>اطلاعات ارسال</span>
                            </a>
                        </li>
                        <li class="is-completed is-completed-active">
                            <a href="shopping-payment.html" class="checkout-steps-item-link active-link-shopping">
                                <span>پرداخت</span>
                            </a>
                        </li>
                        <li class="is-active">
                            <a href="shopping-complate-buy.html" class="checkout-steps-item-link active-link-shopping">
                                <span>اتمام خرید و ارسال</span>
                            </a>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </header>
    <!--header------------------------------------->
    @yield('Content')
    <!--footer------------------------------------->
    <footer class="footer-light">
        <div class="container">
            <ul class="footer-light-link">
                <li><a href="#">درباره موبالینو</a></li>
                <li><a href="#">فرصت‌های شغلی</a></li>
                <li><a href="#">تماس با ما</a></li>
                <li><a href="#">همکاری با سازمان‌ها</a></li>
            </ul>

            <p class="title-footer">استفاده از مطالب فروشگاه اینترنتی دیجی‌اسمارت فقط برای مقاصد غیرتجاری و با ذکر منبع
                بلامانع است. کلیه حقوق این سایت متعلق به شرکت نوآوران فن آوازه (فروشگاه آنلاین دیجی‌اسمارت) می‌باشد.</p>

            <p class="copy-right-footer-light">Copyright © 2006 - 2019 DigiSmart.com</p>
        </div>
    </footer>
    <!--footer------------------------------------->
</body>
<!--jquery--------------------------------------->
<script src="{{ load('assets/js/jquery-3.2.1.min.js') }}"></script>
<!--    bootstrap-------------------------------->
<script src="{{ load('assets/js/bootstrap.js') }}"></script>
<!--main----------------------------------------->
<script src="{{ load('assets/js/main.js') }}"></script>
@yield('script')
</html>
