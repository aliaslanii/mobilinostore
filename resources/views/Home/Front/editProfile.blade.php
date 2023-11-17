@extends('Home.Layout.Profile')
@section('Content')        
<!--profile------------------------------------>
     <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
         <section class="page-contents">
             <div class="profile-content">
                 <div class="profile-navbar">
                     <div class="profile-navbar-back-alignment">
                         <a href="{{ route('Profile') }}" class="profile-navbar-btn-back">بازگشت</a>
                         <h4 class="edit-personal">ویرایش اطلاعات شخصی</h4>
                     </div>
                 </div>
                 <form method="POST" action="{{ route('insertProfile') }}">
                    @csrf
                    <div class="profile-stats">
                        <div class="profile-stats-row">
                            <fieldset class="form-legal-fieldset">
                                <h4 class="form-legal-headline">حساب شخصی</h4>
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                            <span class="profile-first-title"> نام :</span>
                                            <input class="ui-input-field" type="text" name="name" value="{{ Auth::user()->name }}" placeholder="نام خود را وارد کنید">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                            <span class="profile-first-title"> نام کاربری :</span>
                                            <input class="ui-input-field" type="text" name="username" value="{{ Auth::user()->username }}" placeholder="نام کاربری خود را وارد کنید">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                            <span class="profile-first-title"> پست الکترونیک :</span>
                                            <input class="ui-input-field" type="text" name="email" value="{{ Auth::user()->email }}" placeholder="پست الکترونیک خود را وارد کنید">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                            <span class="profile-first-title"> کد ملی :</span>
                                            <input class="ui-input-field" type="text" name="codemeli" value="{{ Auth::user()->codemeli }}" placeholder="کد ملی  خود را وارد کنید">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                            <span class="profile-first-title"> شماره موبایل</span>
                                            <input class="ui-input-field" type="text" disabled name="mobile" value="{{ Auth::user()->mobile }}" placeholder="شماره موبایل خود را وارد کنید">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                            <span class="profile-first-title"> شماره کارت</span>
                                            <input class="ui-input-field" type="text" name="cardnumber" value="{{ Auth::user()->cardnumber}}" placeholder="شماره کارت خود را وارد کنید">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-12" style="padding:0;">
                                <div class="profile-stats-row form-legal-row-submit">
                                    <div class="parent-btn parent-store">
                                        <button type="submit" class="dk-btn dk-btn-info btn-store">
                                            ثبت اطلاعات کاربری
                                            <i class="fa fa-sign-in"></i>
                                        </button>
                                    </div>
                                    <a href="{{ route('Profile') }}" class="btn btn-default-gray">انصراف</a>     
                                </div>
                            </div>
                        </div>
                    </div>
                 </form>
             </div>
         </section>
     </div>
<!--profile------------------------------------>
@endsection