<!DOCTYPE html>
<html lang="fa" dir="rtl">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <!-- meta -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
      <meta name="description" content="Spruha -  Admin Panel laravel Dashboard Template">
      <meta name="author" content="Spruko Technologies Private Limited">
      <meta name="keywords" content="admin laravel template, template laravel admin, laravel css template, best admin template for laravel, laravel blade admin template, template admin laravel, laravel admin template bootstrap 4, laravel bootstrap 4 admin template, laravel admin bootstrap 4, admin template bootstrap 4 laravel, bootstrap 4 laravel admin template, bootstrap 4 admin template laravel, laravel bootstrap 4 template, bootstrap blade template, laravel bootstrap admin template">
      
      <!-- Favicon -->
      <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">

      <!-- Title -->
      <title>Admin MobilinoStore | مدریت فروشگاه موبایلینو</title>
  
      <!-- Bootstrap css-->
      <link href="{{ loadA('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
      
      <!-- Icons css-->
      <link href="{{ loadA('assets/plugins/web-fonts/icons.css') }}" rel="stylesheet"/>
      <link href="{{ loadA('assets/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ loadA('assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet"/>
      
      <!-- Style css-->
      <link href="{{ loadA('assets/css-rtl/style/style.css') }}" rel="stylesheet">
      <link href="{{ loadA('assets/css-rtl/skins.css') }}" rel="stylesheet">
      <link href="{{ loadA('assets/css-rtl/dark-style.css') }}" rel="stylesheet">
      <link href="{{ loadA('assets/css-rtl/colors/default.css') }}" rel="stylesheet">
      <link href="{{ loadA('assets/css-rtl/style/Custom.css') }}" rel="stylesheet">
      
      <!-- Color css-->
      <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ loadA('assets/css-rtl/colors/color.css') }}">
      
      <!-- Select2 css -->
      <link href="{{ loadA('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
      <!-- add css -->
      @yield('link')

      <!-- Sidemenu css-->
      <link href="{{ loadA('assets/css-rtl/sidemenu/sidemenu.css') }}" rel="stylesheet">
      
      <!-- Switcher css-->
      <link href="{{ loadA('assets/switcher/css/switcher-rtl.css') }}" rel="stylesheet">
      <link href="{{ loadA('assets/switcher/demo.css') }}" rel="stylesheet">

      <!-- ionicons-->
      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
   </head>

   <body class="main-body leftmenu">
      <!-- Loader Main -->
      <div class="loader-div-main">
         <div class="modal-loader"></div>
      </div>
      <!-- End Loader Main -->
      <!-- Loader -->
      <div class="loader-div">
         <div class="modal-loader"></div>
      </div>
      <!-- End Loader -->
      <!-- Page -->
      <div class="page">
      
         <!-- Sidemenu -->
         <div class="main-sidebar main-sidebar-sticky side-menu">
            <div class="sidemenu-logo">
               <a class="main-logo" href="{{ route('Admin') }}">
                  <img src="{{ asset('images/logo/AliAslani.png') }}" class="header-brand-img desktop-logo" alt="لوگو">
                  <img src="{{ asset('images/logo/AliAslani.png') }}" class="header-brand-img icon-logo" alt="لوگو">
                  <img src="{{ asset('images/logo/AliAslani2.png') }}" class="header-brand-img desktop-logo theme-logo" alt="لوگو">
                  <img src="{{ asset('images/logo/AliAslani2.png') }}" class="header-brand-img icon-logo theme-logo" alt="لوگو">
               </a>
            </div>
            <div class="main-sidebar-body">
               <ul class="nav">
                  <li class="nav-header"><span class="nav-label">داشبورد</span></li>
                  <li class="nav-item @if(request()->is('admin')) active @endif">
                     <a class="nav-link" href="{{ route('Admin') }}"><span class="shape1"></span><span class="shape2"></span><ion-icon class="icon-dashbord" name="home-outline"></ion-icon><span class="sidemenu-label">داشبورد</span></a>
                  </li>
                  <li class="nav-item @if(request()->is('admin/Category/*') || request()->is('admin/Categorys')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><ion-icon class="icon-adminindex" name="grid-outline"></ion-icon><span class="sidemenu-label">دسته بندی محصولات</span><i class="angle fe fe-chevron-left"></i></a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/Categorys')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Categorys') }}"> دسته بندی ها</a>
                        </li>
                        <li class="nav-sub-item @if(request()->is('admin/Category/TitleGroups')) active @endif">
                           <a class="nav-sub-link" href="{{ route('TitleGroups') }}">تیتر گروه ها</a>
                        </li>
                        <li class="nav-sub-item @if(request()->is('admin/Category/Groups')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Groups') }}">گروه ها</a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item @if(request()->is('admin/Berands')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2">
                        </span><ion-icon class="icon-adminindex" name="logo-bitcoin"></ion-icon><span class="sidemenu-label">برند محولات</span><i class="angle fe fe-chevron-left"></i>
                     </a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/Berands')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Berands') }}">برند ها</a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item @if(request()->is('admin/Colors')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2">
                        </span><ion-icon class="icon-adminindex"  name="color-fill-outline"></ion-icon><span class="sidemenu-label">رنگ محصولات</span><i class="angle fe fe-chevron-left"></i>
                     </a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/Colors')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Colors') }}">لیست رنگ ها</a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item @if(request()->is('admin/Products') || request()->is('admin/Product/Create')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2">
                        </span><ion-icon class="icon-adminindex" name="qr-code-outline"></ion-icon><span class="sidemenu-label">محصولات</span><i class="angle fe fe-chevron-left"></i>
                     </a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/Products')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Products') }}">لیست محصولات</a>
                        </li>
                        <li class="nav-sub-item @if(request()->is('admin/Products/defective')) active @endif">
                           <a class="nav-sub-link" href="{{ route('DefectiveProducts') }}">لیست محصولات ناقص</a>
                        </li>
                        <li class="nav-sub-item @if(request()->is('admin/Product/Create')) active @endif">
                           <a class="nav-sub-link" href="{{ route('CreateProduct') }}">ایجاد محصولات</a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item @if(request()->is('admin/Baskets/*') || request()->is('admin/Baskets')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2">
                        </span><ion-icon class="icon-adminindex"  name="cart-outline"></ion-icon><span class="sidemenu-label">سبد های خرید</span><i class="angle fe fe-chevron-left"></i>
                     </a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/Baskets')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Baskets') }}">لیست تمامی سبد ها </a>
                        </li>
                        <li class="nav-sub-item @if(request()->is('admin/Baskets/send')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Basketssend') }}">لیست سبد های ارسال شده </a>
                        </li>
                        <li class="nav-sub-item @if(request()->is('admin/Baskets/paydone')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Basketspaydone') }}">لیست سبد های پرداخت شده </a>
                        </li>
                        <li class="nav-sub-item @if(request()->is('admin/Baskets/cancel')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Basketscancel') }}">لیست سبد های لغو شده </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item @if(request()->is('admin/Commnets')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2">
                        </span><ion-icon class="icon-adminindex"  name="chatbubble-ellipses-outline"></ion-icon><span class="sidemenu-label">کامنت ها</span><i class="angle fe fe-chevron-left"></i>
                     </a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/Commnets')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Commnets') }}">لیست کامنت ها </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item @if(request()->is('admin/StateCity')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2">
                        </span><ion-icon class="icon-adminindex" name="earth-outline"></ion-icon><span class="sidemenu-label">استان و شهر ها</span><i class="angle fe fe-chevron-left"></i>
                     </a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/StateCity')) active @endif">
                           <a class="nav-sub-link" href="{{ route('StateCity') }}">لیست استان و شهر ها </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item @if(request()->is('admin/messages')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2">
                        </span><ion-icon class="icon-adminindex"  name="paper-plane-outline"></ion-icon><span class="sidemenu-label">پیام کاربران</span><i class="angle fe fe-chevron-left"></i>
                     </a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/messages')) active @endif">
                           <a class="nav-sub-link" href="{{ route('messages') }}">لیست پیام های کاربران </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item @if(request()->is('admin/Assets')) active show  @endif">
                     <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2">
                        </span><ion-icon class="icon-adminindex"  name="image-outline"></ion-icon><span class="sidemenu-label">تصاویر وب سایت</span><i class="angle fe fe-chevron-left"></i>
                     </a>
                     <ul class="nav-sub">
                        <li class="nav-sub-item @if(request()->is('admin/Assets')) active @endif">
                           <a class="nav-sub-link" href="{{ route('Assets') }}">لیست تصاویر وب سایت </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
         <!-- End Sidemenu -->
         <!-- Main Header-->
         <div class="main-header side-header sticky">
            <div class="container-fluid">
               <div class="main-header-right">
                  <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
               </div>
               <div class="main-header-center">
                  <div class="responsive-logo">
                     <a href="{{ route('Admin') }}"><img src="{{ asset('images/logo/AliAslani2.png') }}" class="mobile-logo" alt="لوگو"></a>
                     <a href="{{ route('Admin') }}"><img src="{{ asset('images/logo/AliAslani2.png') }}" class="mobile-logo-dark" alt="لوگو"></a>
                  </div>
               </div>
               <div class="main-header-right">
                  <div class="dropdown main-profile-menu">
                     <a class="d-flex" href="#">
                        
                        @if (Auth::user()->img != null)
                        <span class="main-img-user"><img alt="آواتار" src="{{ asset('images/User-image/'.Auth::user()->img) }}"></span>
                        @else
                        <span class="main-img-user"><img style="width: 60%;height: 96%;" alt="آواتار" src="{{ asset('images/User-image/default.png') }}"></span>
                        @endif
                     </a>
                     <div class="dropdown-menu">
                        <div class="header-navheading">
                           <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                        </div>
                        <a class="dropdown-item border-top" href="{{ route('AdminProfile') }}">
                           <i class="fe fe-user"></i> پروفایل من
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                           <i class="fe fe-power"></i> خروج از سیستم
                        </a>
                     </div>
                  </div>
                  <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="تغییر پیمایش">
                     <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                  </button><!-- Navresponsive closed -->
               </div>
            </div>
         </div>
         <!-- Main Content-->
         <div class="main-content side-content pt-0">
            <div class="container-fluid">
               <div class="inner-body">
                @yield('Content')
               </div>
            </div>
         </div>
         <!-- End Main Content-->
      
      </div>
<!-- End Page -->

<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
<!-- Jquery js-->
<script src="{{ loadA('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap js-->
<script src="{{ loadA('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ loadA('assets/plugins/bootstrap/js/bootstrap-rtl.js') }}"></script>

<!-- Perfect-scrollbar js -->
<script src="{{ loadA('assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js') }}"></script>

<!-- Sidemenu js -->
<script src="{{ loadA('assets/plugins/sidemenu/sidemenu-rtl.js') }}"></script>

<!-- Sidebarjs -->
<script src="{{ loadA('assets/plugins/sidebar/sidebar-rtl.js') }}"></script>

<!-- Select2 js-->
<script src="{{ loadA('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- add js file -->
@yield('script')

<!-- Sticky js -->
<script src="{{ loadA('assets/js/sticky.js') }}"></script>

<!-- Custom js -->
<script src="{{ loadA('assets/js/custom.js') }}"></script>

<!-- Switcher js -->
<script src="{{ loadA('assets/switcher/js/switcher-rtl.js') }}"></script>

<!-- dataTables-->
<script src="{{ loadA('assets/js/Custom/jquery.dataTables.min.js') }}"></script>
<script src="{{ loadA('assets/js/Custom/dataTables.bootstrap4.min.js') }}"></script>

<script>
   $(document).ready(function() {
      $(".loader-div-main").hide();
   });
   function addCommas(nStr)
   {
      nStr += '';
      x = nStr.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;
      while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }
      return x1 + x2;
   }
</script>
</body>
</html>