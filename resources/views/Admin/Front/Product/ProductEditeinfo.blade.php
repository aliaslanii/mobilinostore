@extends('Admin.Layout.Home')
@section('Content')
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">ویرایش اطلاعات محصول</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a>محصولات</li>
                <li class="breadcrumb-item"> لیست محصولات </li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش اطلاعات محصول</li>
            </ol>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Row -->
    <div class="container">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="col-12 borderr form-wizard-1 mt-4 mb-5">
                            <center>
                                <h3>ویرایش مشخصات محصول</h3>
                            </center>
                            <form action="{{ route('UpdateProduct') }}" id="Product-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row row-sm">
                                    <div class="col-lg-12 form-group">
                                        <label class="form-label">تیتر : <span class="tx-danger">*</span></label>
                                        <input type="text" class="form-control required"
                                            value="{{ $Product->title }}" name="title"
                                            placeholder="مثال : گوشی موبایل اپل مدل iPhone 11 تک سیم‌ کارت ظرفیت 128 گیگابایت و رم 4 گیگابایت">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label class="form-label">نام : <span class="tx-danger">*</span></label>
                                        <input type="text" class="form-control required" value="{{ $Product->Name }}"
                                            name="Name" placeholder="نام محصول">
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label class="form-label">ارسال : <span class="tx-danger">*</span></label>
                                        <input type="text" class="form-control required" value="{{ $Product->send }}"
                                            name="send" placeholder="زمان ارسال محصول به روز"
                                            oninput="this.value = this.value.replace(/\D+/g, '')">
                                    </div>
                                </div>
                                <div class="row row-sm">
                                    <div class="col-lg-6 form-group">
                                        <label class="form-label">دسته بندی محصول : <span
                                                class="tx-danger">*</span></label>
                                        <select name="Category" class="form-control select2 required">
                                            <option label="یکی را انتخاب کن">
                                            </option>
                                            @foreach ($Categorys as $Category)
                                                @if ($Product->Categories()->id == $Category->id)
                                                    <option selected value="{{ $Category->id }}">{{ $Category->Name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $Category->id }}">{{ $Category->Name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label class="form-label">برند محصول : <span class="tx-danger">*</span></label>
                                        <select name="Berand" class="form-control select2 required">
                                            <option label="یکی را انتخاب کن">
                                            </option>
                                            @foreach ($Berands as $Berand)
                                                @if ($Product->Berand()->id == $Berand->id)
                                                    <option selected value="{{ $Berand->id }}">{{ $Berand->Name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $Berand->id }}">{{ $Berand->Name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" class="id-Product" value="{{ $Product->id }}" name="id">
                                <button type="submit"
                                    class="btn ripple btn-primary me-1 float-left" style="margin-top: 4.3rem;">تایید</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
@section('script')
    <script>
        $("#Product-form").submit(function(){
            $(".loader-div").show();
        });
    </script>
@endsection