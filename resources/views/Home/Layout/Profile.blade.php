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
    @yield('link')
</head>

<body>
    <!-- Loader -->
    <div class="loader-div">
        <div class="page-loader"></div>
    </div>
    <!-- End Loader -->
    <!--header------------------------------------->
    <header>
        <aside class="adplacement-top-header">
            <a href="index.html" class="adplacement-item" title="شگفت سوپرمارکتی"></a>
        </aside>
        <div class="container-main">
            <div class="col-lg-8 col-md-8 col-xs-12 pull-right">
                <div class="header-right">
                    <div class="logo">
                        <a href="{{ route('index') }}"><img class="img-logo" src="{{ asset('images/logo/mobilno-logo.png') }}"></a>
                    </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pull-right">
                        <div class="search-header">
                            <form action="{{ route('Search') }}" method="GET">
                                <input type="text" class="search-input" name="q"
                                    placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید…"
                                    @if (request()->is('Search'))
                                    value="{{ $q }}">
                                    @endif
                                <button type="submit" class="button-search">
                                    <img src="{{ load('assets/images/search.png') }}">
                                </button>
                            </form>
                            <div class="search-result">
                                <ul class="search-result-list mb-0">
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            فروشگاه ها
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            محصولات
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            کالای دیجیتال
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            ثبت فروشگاه
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="mdi mdi-clock-outline"></i>
                                            ظروف
                                            <button class="btn btn-light btn-remove-search" type="submit">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                <div class="header-left">
                    <ul class="nav-lr">
                        <li class="nav-item-account">
                            <a href="#">
                                <img src="{{ load('assets/images/user.png') }}" alt="user">
                                حساب کاربری
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('Profile') }}" class="dropdown-item">
                                                <i class="mdi mdi-account-card-details-outline"></i>
                                                حساب کاربری من
                                            </a>
                                        </li>
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('logout') }}" class="dropdown-item">
                                                <i class="mdi mdi-logout-variant"></i>
                                                خروج از حساب
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="overlay-search-box"></div>
        </div>
        <!--        menu------------------------------->
        <nav class="main-menu">
            <div class="container-main">
                <div>
                    <ul class="list-menu">
                        <li class="item-list-menu megamenu nav-overlay">
                            <a href="#" class="list-category">محصولات<i class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu">
                                @foreach (Categorys() as $Category)
                                <li class="list-item-children">
                                    <a href="{{ route('SearchCategory',['id' => $Category->id]) }}" class="list-item-children-category"><img src="{{ asset('images/Category-image/'.$Category->img) }}">{{ $Category->Name }}</a>
                                    <ul class="megamenu-level-3">
                                        <a href="#" class="list-category-megamenu">همه دسته بندی های {{ $Category->Name }}</a>
                                        <li class="level-three-menu">
                                            <ul>
                                                @foreach ($Category->Titlegroups() as $Titlegroup)
                                                    <a class="mega-menu-sublist-title" href="{{ route('SearchTitleGroup',['id' => $Titlegroup->id]) }}">{{ $Titlegroup->title }}<i class="fa fa-angle-left"></i></a>
                                                    @foreach ($Titlegroup->Groups() as $Group)
                                                        <li class="megamenu-list-item"><a href="{{ route('SearchGroups',['id' => $Group->id]) }}" class="megamenu-category">{{ $Group->title }}</a></li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="item-list-menu megamenu">
                            <a href="{{ route('about') }}" class="list-category">درباره ما</a>
                        </li>
                        <li class="item-list-menu megamenu">
                            <a href="{{ route('ContactUs') }}" class="list-category">تماس با ما</a>
                        </li>
                        <li class="nav-item-account nav-item-cart ProductsBasket">
                            <div class="dropdownBasket">
                                <a href="#">
                                    <span class="mdi mdi-shopping"></span>
                                    سبد خرید
                                    <span class="count count-ProducBasket">{{ CPB(bpu()) }}</span>
                                </a>
                                <div class="dropdown-menu-cart">
                                    <div class="dropdown-header">
                                        <a href="#" class="view-cart">مشاهده سبد خرید</a>
                                    </div>
                                    <div class="wrapper">
                                        <div class="scrollbar" id="style-1">
                                            <div class="force-overflow">
                                                <ul class="dropdown-list">
                                                    @if(bpu() != null)
                                                        @foreach (bpu() as $ProducBasket)
                                                            @if ($ProducBasket->count > 0)
                                                                @if ($ProducBasket->Products()->SumNumber > 0)
                                                                <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $ProducBasket->Products()->P_id, 'Name' => $ProducBasket->Products()->Name, 'Color' => Color($ProducBasket->Products())]) }}">
                                                                    <li class="dropdown-item">
                                                                        <div class="title-cart">
                                                                            <img src="{{ asset('images/Products-image/'.$ProducBasket->Products()->img) }}">
                                                                            <h3>{{ $ProducBasket->Products()->title }}</h3>
                                                                            <span><b>رنگ : </b> {{ $ProducBasket->Color()->Name }}</span><ion-icon style="top:.5rem;color: {{ $ProducBasket->Color()->Color }}" name="radio-button-on-sharp"></ion-icon>
                                                                            <div class="price">{{ number_format(ProductBasketPrice($ProducBasket) ) }}<span>تومان</span></div>
                                                                            <div class="Count-span"><b>تعداد : </b> {{ $ProducBasket->count }}</div>
                                                                        </div>
                                                                    </li>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer-dropdown">
                                        <div class="amount-total-buy">
                                            <div class="price">
                                                <span class="total">مبلغ کل خرید :</span>
                                                <span class="toman">{{ number_format(SumBasket(bpu())) }}
                                                    <span>تومان</span>
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('BasketShow') }}" class="checkout">ثبت سفارش</a>
                                    </div>
                                </div>    
                            </div> 
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nav-btn nav-slider">
                <span class="linee1"></span>
                <span class="linee2"></span>
                <span class="linee3"></span>
            </div>
        </nav>
        <!--        menu------------------------------->

        <!--    menu-responsiver----------------------->
         @if(Session::get('messagesend'))
         <div dir="rtl" style="margin-top: .2rem;" class="row er">            
            <div class="alert alert-success alert-dismissible fade show col-md-4 mt-4">
            <strong>@lang('validation-attributes.success') : </strong><span>{{ (Session::get('messagesend')) }}</span>
            <ion-icon class="btn-close" name="close-sharp"></ion-icon>
            </div>
        </div>
        @endif
        <nav class="sidebar">
            <div class="nav-header">
                <!--              <img class="pic-header" src="images/header-pic.jpg" alt="">-->
                <div class="header-cover"></div>
                <div class="logo-wrap">
                    <a class="logo-icon" href="#"><img alt="logo-icon"
                            src="{{ asset('images/logo/logo.png') }}" style="width: 40px"></a>
                </div>
            </div>
           
            <ul class="nav-categories ul-base">
                <li><a href="#" class="collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i
                            class="mdi mdi-chevron-down"></i>محصولات</a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                        data-parent="#accordionExample" style="">
                        <ul>
                            @foreach (Categorys() as $Category)
                                <li class="has-sub"><a href="#" class="category-level-2">{{ $Category->Name }}</a>
                                    <ul>
                                        @foreach ($Category->Titlegroups() as $Titlegroup)
                                            <li><a href="#" class="category-level-3">{{ $Titlegroup->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li><a href="{{ route('about') }}">درباره ما</a></li>
                <li><a href="{{ route('ContactUs') }}">تماس با ما</a></li>
            </ul>
        </nav>
        <div class="overlay"></div>
        <!--    menu-responsiver----------------------->

    </header>
    <!--        menu------------------------------->

    <!--    menu-responsiver----------------------->
    <nav class="sidebar">
        <div class="nav-header">
            <!--              <img class="pic-header" src="images/header-pic.jpg" alt="">-->
            <div class="header-cover"></div>
            <div class="logo-wrap">
                <a class="logo-icon" href="#"><img alt="logo-icon" src="{{ load('assets/images/logo.png') }}"
                        width="40"></a>
            </div>
        </div>
        <ul class="nav-categories ul-base">
            <li><a href="#">فروشگاه</a></li>
            <li><a href="#" class="collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i
                        class="mdi mdi-chevron-down"></i>محصولات</a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample"
                    style="">
                    <ul>
                        @foreach (Categorys() as $Category)
                            <li class="has-sub"><a href="#" class="category-level-2">{{ $Category->Name }}</a>
                                <ul>
                                    @foreach ($Category->Titlegroups() as $Titlegroup)
                                        <li><a href="#" class="category-level-3">{{ $Titlegroup->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li><a href="#">ثبت فروشگاه</a></li>
            <li><a href="#">مقالات</a></li>
            <li><a href="#">درباره ما</a></li>
            <li><a href="#">تماس با ما</a></li>
        </ul>
    </nav>
    <div class="overlay"></div>
    <!--    menu-responsiver----------------------->
    <nav class="sidebar">
        <div class="nav-header">
            <!--              <img class="pic-header" src="images/header-pic.jpg" alt="">-->
            <div class="header-cover"></div>
            <div class="logo-wrap">
                <a class="logo-icon" href="#"><img alt="logo-icon" src="assets/images/logo.png"
                        width="40"></a>
            </div>
        </div>
        <ul class="nav-categories ul-base">
            <li><a href="#">فروشگاه</a></li>
            <li><a href="#" class="collapsed" type="button" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i
                        class="mdi mdi-chevron-down"></i>محصولات</a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample"
                    style="">
                    <ul>
                        <li class="has-sub"><a href="#" class="category-level-2">فرش و تابلو فرش</a>
                            <ul>
                                <li><a href="#" class="category-level-3">فرش و تابلو فرش</a></li>
                                <li><a href="#" class="category-level-3">فرش و تابلو فرش</a></li>
                                <li><a href="#" class="category-level-3">فرش و تابلو فرش</a></li>
                                <li><a href="#" class="category-level-3">فرش و تابلو فرش</a></li>
                            </ul>
                        </li>
                        <li class="has-sub"><a href="#" class="category-level-2">طلا و جواهر</a>
                            <ul>
                                <li><a href="#" class="category-level-3">طلا و جواهر</a></li>
                                <li><a href="#" class="category-level-3">طلا و جواهر</a></li>
                                <li><a href="#" class="category-level-3">طلا و جواهر</a></li>
                                <li><a href="#" class="category-level-3">طلا و جواهر</a></li>
                            </ul>
                        </li>
                        <li class="has-sub"><a href="#" class="category-level-2">کالای دیجیتال</a>
                            <ul>
                                <li><a href="#" class="category-level-3">کالای دیجیتال</a></li>
                                <li><a href="#" class="category-level-3">کالای دیجیتال</a></li>
                                <li><a href="#" class="category-level-3">کالای دیجیتال</a></li>
                            </ul>
                        </li>
                        <li class="has-sub"><a href="#" class="category-level-2">ظروف</a>
                            <ul>
                                <li><a href="#" class="category-level-3">ظروف</a></li>
                                <li><a href="#" class="category-level-3">ظروف</a></li>
                                <li><a href="#" class="category-level-3">ظروف</a></li>
                                <li><a href="#" class="category-level-3">ظروف</a></li>
                                <li><a href="#" class="category-level-3">ظروف</a></li>
                            </ul>
                        </li>
                        <li class="has-sub"><a href="#" class="category-level-2">پوشاک</a>
                            <ul>
                                <li><a href="#" class="category-level-3">پوشاک</a></li>
                                <li><a href="#" class="category-level-3">پوشاک</a></li>
                                <li><a href="#" class="category-level-3">پوشاک</a></li>
                                <li><a href="#" class="category-level-3">پوشاک</a></li>
                            </ul>
                        </li>
                        <li class="has-sub"><a href="#" class="category-level-2">مبلمان</a>
                            <ul>
                                <li><a href="#" class="category-level-3">مبلمان</a></li>
                                <li><a href="#" class="category-level-3">مبلمان</a></li>
                                <li><a href="#" class="category-level-3">مبلمان</a></li>
                                <li><a href="#" class="category-level-3">مبلمان</a></li>
                                <li><a href="#" class="category-level-3">مبلمان</a></li>
                                <li><a href="#" class="category-level-3">مبلمان</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a href="#">ثبت فروشگاه</a></li>
            <li><a href="#">مقالات</a></li>
            <li><a href="#">درباره ما</a></li>
            <li><a href="#">تماس با ما</a></li>
        </ul>
    </nav>
    <div class="overlay"></div>
    <!--    menu-responsiver----------------------->
    </header>
    <!--header------------------------------------->
    <!--profile------------------------------------>
    <div class="container-main">
        <div class="col-12">
            <div class="breadcrumb-container">
                <ul class="js-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" class="breadcrumb-link">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('Profile') }}" class="breadcrumb-link">حساب کاربری من</a>
                    </li>
                    <li class="breadcrumb-item">
                        @if (request()->is('Profile'))
                            <a href="#" class="breadcrumb-link active-breadcrumb">پروفایل</a>
                        @elseif (request()->is('Basket/Continued'))
                            <a href="#" class="breadcrumb-link active-breadcrumb">سفارشات شما</a>
                        @elseif (request()->is('Faverit/Products'))
                            <a href="#" class="breadcrumb-link active-breadcrumb">محصولات مورد علاقه شما</a>
                        @elseif (request()->is('Address'))
                            <a href="#" class="breadcrumb-link active-breadcrumb">آدرس ها</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        @if (Session::get('updatedone'))
            <div dir="rtl" style="margin-top: .2rem;" class="row er">
                <div class="alert alert-success alert-dismissible fade show col-md-4 mt-4">
                    <strong>@lang('validation-attributes.success')</strong><span>{{ Session::get('updatedone') }}</span>
                    <ion-icon class="btn-close" name="close-sharp"></ion-icon>
                </div>
            </div>
        @endif
        <div class="col-lg-3 col-md-3 col-xs-12 pull-right">
            <section class="page-aside">
                <div class="sidebar-wrapper">
                    <div class="box-sidebar">
                        <div class="profile-box">
                            <div class="profile-box-avator">
                                <img src="{{ asset('images/User-image/default.png') }}">
                            </div>
                            <div class="profile-box-content">
                                <span class="profile-box-nameuser">{{ Auth::user()->name }}</span>
                                <span class="profile-box-phone">شماره همراه : {{ Auth::user()->mobile }}</span>
                                <a href="#"><span class="profile-box-row-arrow">کیف پول : {{ getwallet() }}
                                        تومان </span></a>
                            </div>
                            <div class="profile-box-tabs">
                                <a href="{{ route('Updatepassword') }}" class="profile-box-tab">تغییر رمز</a>
                                <a href="{{ route('logout') }}" class="profile-box-tab-sign-out">خروج از حساب</a>
                            </div>
                        </div>
                    </div>
                    <div class="box-sidebar">
                        <span class="box-header-sidebar">حساب کاربری شما</span>
                        <ul class="profile-menu-items">
                            <li>
                                <a href="{{ route('Profile') }}"
                                    class="profile-menu-url @if (request()->is('Profile')) active-profile @endif">
                                    <span class="mdi mdi-account-outline"></span>
                                    پروفایل</a>
                            </li>
                            <li>
                                <a href="{{ route('BasketContinued') }}"
                                    class="profile-menu-url @if (request()->is('Basket/Continued')) active-profile @endif">
                                    <span class="fa fa-shopping-basket"></span>
                                    همه سفارش ها</a>
                            </li>
                            <li>
                                <a href="{{ route('FaveritProducts') }}"
                                    class="profile-menu-url @if (request()->is('Faverit/Products')) active-profile @endif">
                                    <span class="fa fa-star-o"></span>
                                    لیست علاقه مندی ها</a>
                            </li>
                            <li>
                                <a href="{{ route('Address') }}"
                                    class="profile-menu-url @if (request()->is('Address')) active-profile @endif">
                                    <span class="mdi mdi-map"></span>
                                    آدرس ها</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
        @yield('Content')
        <!--footer------------------------------------->
        <footer class="footer mt-3">
            <div class="row">
                <div class="footer-jumpup">
                    <div class="container">
                        <a href="#">
                            <span href="#" class="footer-jumpup-container"><i
                                    class="fa fa-angle-up"></i></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <nav class="footer-feature-innerbox mb-1">
                    <div class="footer-badge-item">
                        <a href="#" class="footer-badge-link">
                            <img src="{{ asset('images/footer/delivery.svg') }}">
                            <span class="footer-badge-title">تحویل اکسپرس</span>
                        </a>
                    </div>
                    <div class="footer-badge-item">
                        <a href="#" class="footer-badge-link">
                            <img src="{{ asset('images/footer/contact-us.svg') }}">
                            <span class="footer-badge-title">پشتیبانی 24 ساعته</span>
                        </a>
                    </div>
                    <div class="footer-badge-item">
                        <a href="#" class="footer-badge-link">
                            <img src="{{ asset('images/footer/payment-terms.svg') }}">
                            <span class="footer-badge-title">پرداخت درمحل</span>
                        </a>
                    </div>
                    <div class="footer-badge-item">
                        <a href="#" class="footer-badge-link">
                            <img src="{{ asset('images/footer/return-policy.svg') }}">
                            <span class="footer-badge-title">۷ روز ضمانت بازگشت</span>
                        </a>
                    </div>
                    <div class="footer-badge-item">
                        <a href="#" class="footer-badge-link">
                            <img src="{{ asset('images/footer/origin-guarantee.svg') }}">
                            <span class="footer-badge-title">ضمانت اصل بودن کالا</span>
                        </a>
                    </div>
                </nav>
            </div>
            <article class="container-main">
                <div class="footer-middlebar">
                    <div class="col-lg-8 col-md-8 col-xs-12 pull-right">
                        <div class="footer-links">
                            <div class="col-lg-4 col-md-4 col-xs-12 pull-right">
                                <nav class="footer-links-col">
                                    <div class="headline-links mb-3">
                                        <a href="#">
                                            راهنمای خرید از دیجی‌اسمارت
                                        </a>
                                    </div>
                                    <ul class="footer-links-ul">
                                        <li>
                                            <a href="#">
                                                نحوه ثبت سفارش
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                رویه ارسال سفارش
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                شیوه‌های پرداخت
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12 pull-right">
                                <nav class="footer-links-col">
                                    <div class="headline-links mb-3">
                                        <a href="#">
                                            خدمات مشتریان
                                        </a>
                                    </div>
                                    <ul class="footer-links-ul">
                                        <li>
                                            <a href="#">
                                                پاسخ به پرسش‌های متداول
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                رویه های بازگرداندن کالا
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                شرایط استفاده
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                حریم خصوصی
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                گزارش باگ
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12 pull-right">
                                <nav class="footer-links-col">
                                    <div class="headline-links mb-3">
                                        <a href="#">
                                            با دیجی‌اسمارت
                                        </a>
                                    </div>
                                    <ul class="footer-links-ul">
                                        <li>
                                            <a href="#">
                                                اتاق خبر دیجی‌اسمارت
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                فروش در دیجی‌اسمارت
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                فرصت های شغلی
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                تماس با دیجی‌اسمارت
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                درباره ما دیجی‌اسمارت
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                        <div class="footer-form">
                            <form action="#" class="form-newsletter mb-4 mt-4">
                                <fieldset>
                                    <span class="form-newsletter-title">از تخفیف‌ها و جدیدترین‌های دیجی‌اسمارت
                                        باخبرشوید:</span>
                                    <div class="form-newsletter-row">
                                        <input type="text" class="input-field-send-email"
                                            placeholder="آدرس ایمیل خود را وارد کنید">
                                        <button type="submit" class="btn-secondary-send">ارسال</button>
                                    </div>
                                </fieldset>
                            </form>
                            <div class="footer-community">
                                <div class="footer-social mb-4 mt-4">
                                    <span>دیجی‌اسمارت را در شبکه‌های اجتماعی دنبال کنید:</span>
                                    <div class="footer-social">
                                        <ul class="footer-ul-social">
                                            <li class="footer-social-item">
                                                <a href="#" class="footer-social-link">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li class="footer-social-item">
                                                <a href="#" class="footer-social-link">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="footer-social-item">
                                                <a href="#" class="footer-social-link">
                                                    <i class="fa fa-linkedin-square"></i>
                                                </a>
                                            </li>
                                            <li class="footer-social-item">
                                                <a href="#" class="footer-social-link">
                                                    <i class="fa fa-telegram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-more-info">
                    <div class="footer-description-content">
                        <div class="col-xs-8 col-md-8 col-xs-12 pull-right">
                            <div class="footer-content">
                                <article class="footer-seo mt-3">
                                    <h1>فروشگاه اینترنتی دیجی‌اسمارت، بررسی، انتخاب و خرید آنلاین</h1>
                                    <p>دیجی‌اسمارت به عنوان یکی از قدیمی‌ترین فروشگاه های اینترنتی با بیش از یک دهه
                                        تجربه،
                                        با پایبندی به سه اصل، پرداخت در محل، 7 روز ضمانت بازگشت کالا و تضمین اصل‌بودن
                                        کالا
                                        موفق شده تا همگام با فروشگاه‌های معتبر جهان، به بزرگ‌ترین فروشگاه اینترنتی ایران
                                        تبدیل شود. به محض ورود به سایت دیجی‌اسمارت با دنیایی از کالا رو به رو می‌شوید!
                                        هر
                                        آنچه که نیاز دارید و به ذهن شما خطور می‌کند در اینجا پیدا خواهید کرد.</p>
                                </article>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                                <aside>
                                    <ul class="footer-safety-partner mt-4 pull-left">
                                        <li class="footer-safety-partner-1">
                                            <a href="#">
                                                <img src="{{ load('assets/images/footer/license/L-2.png') }}">
                                            </a>
                                        </li>
                                        <li class="footer-safety-partner-1">
                                            <a href="#">
                                                <img src="{{ load('assets/images/footer/license/L-1.png') }}">
                                            </a>
                                        </li>
                                    </ul>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="footer-copyright-text">
                        استفاده از مطالب فروشگاه اینترنتی دیجی‌اسمارت فقط برای مقاصد غیرتجاری و با ذکر منبع
                        بلامانع است. کلیه حقوق این سایت متعلق به شرکت نوآوران فن آوازه (فروشگاه آنلاین دیجی‌اسمارت)
                        می‌باشد.
                    </div>
                </div>
            </article>
        </footer>
        <!--footer------------------------------------->
</body>
<!--jquery--------------------------------------->
<script src="{{ load('assets/js/jquery-3.2.1.min.js') }}"></script>
<!--    bootstrap-------------------------------->
<script src="{{ load('assets/js/bootstrap.js') }}"></script>
<!--    owl.carousel----------------------------->
<script src="{{ load('assets/js/owl.carousel.min.js') }}"></script>
<!-- sweetalert2--------------------------------->
<script src="{{ load('assets/js/sweetalert2.all.min.js') }}"></script>
<!--main----------------------------------------->
<script src="{{ load('assets/js/main.js') }}"></script>
@yield('script')
<script>
    $(".btn-close").click(function() {
        $('.er').remove();
    });
</script>
</html>