@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">پروفایل شما</h2> 
    </div>
</div>
<!-- End Page Header -->
 <!-- Row -->
 <div class="row row-sm">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div dir="rtl" style="margin-top: .2rem;" class="row er">            
                <div class="alert alert-danger alert-dismissible fade show col-md-4 mt-4">
                <strong>@lang('validation-attributes.alert') </strong><span>{{ $error }}</span>
                </div>
            </div>
        @endforeach
    @endif
    <div class="col-lg-4 col-md-2"></div>
    <div class="col-sm-12 col-lg-4 col-md-8">
        <div class="card custom-card our-team">
            <div class="card-body info">
                <div class="userinfo">
                    <div class="picture avatar-lg online text-center">
                        @if (Auth::user()->img != null)
                        <img class="rounded-circle" src="{{ asset('images/User-image/'.Auth::user()->img) }}">
                        @else
                        <img class="rounded-circle" style="width: 80%;height: 100%;" src="{{ asset('images/User-image/default.png') }}">
                        @endif
                    </div>
                    <div class="text-center mt-3">
                        <h5 id="user-name" class="pro-user-username text-dark mb-2">{{ Auth::user()->name }}</h5>
                        <p  id="user-username" class="pro-user-desc text-muted mb-2">{{ Auth::user()->username }}</p>
                        <h6 id="user-mobile" class="pro-user-username text-dark mb-2">{{ Auth::user()->mobile }}</h6>
                        <p  id="user-email" class="pro-user-desc text-muted mb-2">{{ Auth::user()->email }}</p>
                        <a id="Editimg" href="javascript:void(0)" class="btn btn-warning">تغیر عکس پروفایل</a>
                        <a id="EditProfile" href="javascript:void(0)" class="btn btn-primary">ویرایش اطلاعات</a>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
 <!--End Row -->
 
<!-- Form Modal ProfilModal -->
 <div class="modal" id="ProfilModal">
    <div class="modal-dialog wd-xl-400" role="document">
        <div class="modal-content">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
                <br>
                <h5 id="title-model" class="modal-title mb-4 text-center">ویرایش اطلاعات</h5>
                <form id="UserForm" class="forms-sample text-right" method="POST">
                    <div class="print-error-msg"></div>
                    <div class="form-group">
                        <p class="mg-b-10">نام و نام خانوادگی</p>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name  }}" placeholder="نام و نام خانوادگی خود را وارد کنید">
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">نام کاربری</p>
                        <input type="text" class="form-control" name="username" value="{{ Auth::user()->username  }}" placeholder="نام کاربری خود را وارد کنید">
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">شماره موبایل</p>
                        <input type="text" class="form-control" name="mobile" value="{{ Auth::user()->mobile  }}" placeholder="شماره موبایل خود را وارد کنید">
                    </div>
                    <div class="form-group">
                        <p class="mg-b-10">پست الکترونیک</p>
                        <input type="text" class="form-control" name="email" value="{{ Auth::user()->email  }}" placeholder="پست الکترونیک  خود را وارد کنید">
                    </div>
                    <button type="button" id="saveuser" class="btn ripple btn-success col-12">ویرایش اطلاعات</button>
                </form>
            </div>
        </div>
    </div>
 </div>
 <!-- End Form Modal ProfilModal -->

<!-- Form Modal imgProfilModal -->
 <div class="modal" id="imgProfilModal">
    <div class="modal-dialog wd-xl-400" role="document">
        <div class="modal-content">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
                <br>
                <h5 id="title-model" class="modal-title mb-4 text-center">تغیر تصویر پروفایل</h5>
                <form action="{{ route('AdminProfileUpdateimg') }}" class="forms-sample text-right" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="selectedimg" class="mb-3 mt-3"></div>
                    <div class="input-group file-browser">
                        <label class="input-group-btn">
                            <span class="btn btn-primary col-12">انتخاب عکس<input type="file" id="imginput" accept=".jpg, .jpeg, .png" name="img" style="display: none;"></span>
                        </label>
                    </div>
                    <button id="chengimg" type="submit" class="btn ripple btn-success col-12">تغیر تصویر</button>
                </form>
            </div>
        </div>
    </div>
 </div>
<!-- End Form Modal imgProfilModal -->
@endsection
@section('script')
<script type="text/javascript">
     $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#EditProfile').click(function() {
            $('#ProfilModal').modal('show');
        }); 
        $('#Editimg').click(function() {
            $('#imgProfilModal').modal('show');
        });
        $('#saveuser').click(function() {
            $.ajax({
                url: "{{ route('AdminProfileUpdate') }}",
                data: $('#UserForm').serialize(),
                type: "POST",
                dataType: 'json',
                success: function(data) {
                if(!data.error){
                    $('#user-name').text(data.name);
                    $('#user-username').text(data.username);
                    $('#user-mobile').text(data.mobile);
                    $('#user-email').text(data.email);
                    $('#ProfilModal').modal('hide');
                    $('.er').remove();
                    
                }else{
                    $('.er').remove();
                    printErrorMsg(data.error);
                }
                },
            });
        });
        function printErrorMsg (msg) {
            $.each( msg, function( key, value ) {
                $(".print-error-msg").append('<div dir="rtl" class="row er"><div class="alert alert-danger alert-dismissible fade show col-md-12 mt-1"><strong>خطا ! </strong><span>'+value+'</span></div></div>');
            });
        }
    
        $(".btnCloseModel").click(function() {
            $('#ProfilModal').modal('hide');
            $('#imgProfilModal').modal('hide');
        }); 
    });   
    var selDiv = "";
    var storedFiles = [];
    $(document).ready(function () {
    $("#imginput").on("change", handleFileSelect);
        selDiv = $("#selectedimg");
    });
    function handleFileSelect(e) {
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function (f) {
            if (!f.type.match("image.*")) {
                return;
            }
            storedFiles.push(f);
            var reader = new FileReader();
            reader.onload = function (e) {
                var html =
                '<img src="' +e.target.result + "\" id='img-show' class='img-thumbnail img-category' width='200px'>";
                selDiv.html(html);
            };
            reader.readAsDataURL(f);
        });
    }  
</script> 
@endsection