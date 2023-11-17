@extends('Home.Layout.Profile')
@section('Content')
<div class="col-lg-9 col-md-9 col-xs-12 pull-left">
    <section class="page-contents">
        <div class="profile-content">
            <div class="headline-profile">
                <span>اطلاعات شخصی</span>
            </div>
            <div class="profile-stats">
                <div class="profile-stats-row">
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                        <div class="profile-stats-col">
                            <div class="profile-stats-content">
                                <span class="profile-first-title"> نام و نام خانوادگی :</span>
                                <span class="profile-second-title">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                        <div class="profile-stats-col">
                            <div class="profile-stats-content">
                                <span class="profile-first-title"> نام کاربری  :</span>
                                <span class="profile-second-title">{{ Auth::user()->username }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                        <div class="profile-stats-col">
                            <div class="profile-stats-content">
                                <span class="profile-first-title"> پست الکترونیک :</span>
                                <span class="profile-second-title">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                        <div class="profile-stats-col">
                            <div class="profile-stats-content">
                                <span class="profile-first-title"> شماره تلفن همراه :</span>
                                <span class="profile-second-title">{{ Auth::user()->mobile }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                        <div class="profile-stats-col">
                            <div class="profile-stats-content">
                                <span class="profile-first-title">کد ملی :</span>
                                <span class="profile-second-title">{{ Auth::user()->codemeli }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                        <div class="profile-stats-col">
                            <div class="profile-stats-content">
                                <span class="profile-first-title"> شماره کارت :</span>
                                <span class="profile-second-title">{{ Auth::user()->cardnumber }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-stats-action">
                    <a href="{{ route('editProfile') }}" class="link-spoiler-edit"><i class="fa fa-pencil"></i>ویرایش اطلاعات شخصی</a>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<!--profile------------------------------------>
@endsection
@section('script')
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on("click",'.DisLikebtn' , function() {
            $('.loader-div').show();
            var product_id = $(this).data("id");
            $.ajax({
                data: {'product_id': product_id},
                url: "{{ route('removeFavirate') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('.FaviritProduct').remove();
                    $('.FaviritProductList').append(data.FPL);
                    $('.loader-div').hide();
                }
            });
        });
    });
</script>
@endsection
