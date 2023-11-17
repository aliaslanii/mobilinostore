@extends('Admin.Layout.Home')
@section('link')
    <!-- Internal Specturm-color picker css -->
    <link href="{{ loadA('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
    <!-- Internal Ion.rangeslider css -->
    <link href="{{ loadA('assets/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ loadA('assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
    <!-- Wizard Form css -->
    <link href="{{ loadA('assets/css-rtl/style/Custom.css') }}" rel="stylesheet">
    <!-- InternalFileupload css-->
    <link href="{{ loadA('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!-- filepond css-->
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

@section('Content')
    <!-- Loader -->
    <div class="loader-div">
        <div class="modal-loader"></div>
    </div>
    <!-- End Loader -->

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">ویرایش محصول </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a>محصولات</li>
                <li class="breadcrumb-item"> لیست محصولات </li>
                <li class="breadcrumb-item active" aria-current="page"> ایجاد محصول </li>
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
                        <div class="borderr">
                            <center>
                                <span class="step">1</span><span class="text-form-wizard">اطلاعات اولیه محصول</span>
                                <span class="step">2</span><span class="text-form-wizard">قیمت و تعداد مصحول</span>
                                <span class="step">3</span><span class="text-form-wizard">تصاویر مصحول</span>
                                <span class="step">4</span><span class="text-form-wizard">جزئیات مصحول</span>
                                <span class="step">5</span><span class="text-form-wizard">تائید مصحول</span>
                            </center>
                        </div>
                        <div class="col-12 borderr form-wizard-1 mt-4 mb-5">
                            <!-- form-wizard-page-1 -->
                             <div class="tab">
                                <center>
                                    <h3>مشخصات محصول</h3>
                                </center>
                                <form id="Product-form" method="POST" enctype="multipart/form-data">
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
                                    <div class="row row-sm">
                                        <div class="col-lg-12 form-group">
                                            <label class="form-label">رنگ های مورد نظر برای محصول را انتخاب کنید : <span
                                                    class="tx-danger">*</span></label>
                                            @foreach ($Colors as $Color)
                                                <label class="colorinput"><input
                                                        @foreach ($Product->ColorNumberPrice() as $Colors)  @if ($Colors->Color()->id == $Color->id) checked    @endif @endforeach
                                                        name="Colors[]" value="{{ $Color->id }}" type="checkbox"
                                                        class="colorinput-input required">
                                                    <span style="background-color:{{ $Color->Color }};"
                                                        class="colorinput-color border"></span></label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" class="id-Product" value="{{ $Product->id }}" name="id">
                                    <button type="button"
                                        class="btn ripple btn-primary Product-update me-1 float-left nextBtn" style="margin-top: 4.3rem;"
                                        onclick="nextPrev(1)">بعدی</button>
                                </form>
                            </div>
                            <!-- form-wizard-page-2 -->
                            <div class="tab">
                                <center>
                                    <h3 class="Title-form">قیمت و تعداد محصول</h3>
                                </center>
                                <form id="Product-CPN" method="POST" enctype="multipart/form-data">
                                    <div id="CPN"></div>
                                    <input type="hidden" class="id-Product" value="{{ $Product->id }}"
                                        name="id">
                                    <button type="button"
                                        class="btn ripple btn-primary me-1 CPN-Product float-left nextBtn" style="margin-top: 4.3rem;"
                                        onclick="nextPrev(1)">بعدی</button>
                                </form>
                            </div>
                            <!-- form-wizard-page-3 -->
                            <div class="tab">
                                <center>
                                    <h3>افرودن تصاویر محصول</h3>
                                </center>
                                <form id="Product-images" method="POST" enctype="multipart/form-data">
                                    <div class="row row-vp  mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="mg-b-10">اگر قصد ویرایش تصویر اصلی رو دارید تصویر جدید را وارد کنید</p>
                                                <p class="mg-b-10"> ویرایش تصویر اصلی محصول : </p>
                                                <input type="file" name="img" class="dropify" data-height="200">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="mg-b-10">حذف تصاویر محصول در صفحه بعدی </p>
                                                <p class="mg-b-10">افزودن تصاویر بیشتر به محصول : </p>
                                                <input id="fileupload" name="imgs[]" multiple credits="false" type="file">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $Product->id }}" name="id">
                                    <button type="submit" value="add-image" class="btn ripple btn-primary me-1 images-Product float-left nextBtn" style="margin-top: 4.3rem;"
                                     onclick="nextPrev(1)">بعدی</button>
                                </form>	
                            </div> 
							<!-- form-wizard-page-4 -->
							<div class="tab">
								<center>
									<h3>ویرایش تصاویر محصول</h3>
								</center>
								<form id="Product-images" method="post" action="/" enctype="multipart/form-data">
									<div class="row row-vp mt-2">
                                        <div class="row row-sm Products-images">
                                        
                                        </div>
									</div>
									<input type="hidden" value="{{ $Product->id }}"
										name="id">
									<button type="button" 
										class="btn ripple btn-primary me-1 float-left nextBtn" style="margin-top: 4.3rem;"
										onclick="nextPrev(1)">بعدی</button>
								</form>
							</div>
                            <!-- form-wizard-page-5 -->
                            <div class="tab">
                                <center>
                                    <h3>جزئیات محصول</h3>
                                </center>
                                <form id="Product-DSP" method="POST" enctype="multipart/form-data">
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg-2 form-group mt-2">
                                            <label class="custom-switch">
                                                <input @if ($Discount) checked @endif id="Discount"
                                                    name="Discount" value="1" type="checkbox"
                                                    class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">تخفیف محصول </span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">درصد تخفیف محصول :
                                                    </span>
                                                </div>
                                                <input name="Discount_number" type="text" id="Discount_number"
                                                    class="form-control" maxlength="2"
                                                    oninput="this.value = this.value.replace(/\D+/g, '')"
                                                    placeholder="درصد تخفیف محصول" @if (!$Discount) disabled @endif 
                                                    @if ($Discount) value="{{ $Discount->Discount_number }}" @endif>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mg-b-20">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label for="StartDiscount"
                                                                class="main-content-label mb-1">تاریخ شروع تخفیف</label>
                                                        </div>
                                                    </div><input name="StartDiscount" class="form-control fc-datepicker"
														id="StartDiscount" placeholder="ماه / روز / سال" type="text"
														@if (!$Discount) disabled @endif 
														@if ($Discount) value="{{ verta($Discount->StartTime)->format('Y/m/d') }}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mg-b-20">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label for="EndDiscount" class="main-content-label mb-1">تاریخ
                                                                اتمام تخفیف</label>
                                                        </div>
                                                    </div><input name="EndDiscount" class="form-control fc-datepicker"
                                                        id="EndDiscount" placeholder="ماه / روز / سال" type="text"
														@if (!$Discount) disabled @endif 
                                                        @if ($Discount) value="{{ verta($Discount->EndTime)->format('Y/m/d') }}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg-3 form-group mt-2">
                                            <label class="custom-switch">
                                                <input id="suggested" value="1" name="suggested" type="checkbox"
                                                    class="custom-switch-input" @if ($Suggestion) checked @endif>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">پیشنهاد ویژه محصول</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mg-b-20">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label for="Startsuggested" class="main-content-label mb-1">تاریخ شروع پیشنهاد ویژه</label>
                                                        </div>
                                                    </div><input name="Startsuggested" class="form-control fc-datepicker"
                                                        id="Startsuggested" placeholder="ماه / روز / سال" type="text"
                                                        @if (!$Suggestion) disabled @endif 
														@if ($Suggestion) value="{{ verta($Suggestion->StartTime)->format('Y/m/d') }}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mg-b-20">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <label for="Endsuggested" class="main-content-label mb-1">تاریخ اتمام پیشنهادویژه</label>
                                                        </div>
                                                    </div><input name="Endsuggested" class="form-control fc-datepicker"
                                                        id="Endsuggested" placeholder="ماه / روز / سال" type="text"
                                                        @if (!$Suggestion) disabled @endif 
                                                        @if ($Suggestion) value="{{ verta($Suggestion->EndTime)->format('Y/m/d') }}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-sm  mt-3">
                                        <div class="col-lg-4">
                                            <p class="mg-b-10">انتخاب تیتر گروه ها</p>
                                            <select name="Titlegroups[]" class="form-control select2"
                                                multiple="multiple">
                                                @foreach ($Titlegroups as $Titlegroup)
                                                    <option 
													 @foreach ($ProductsTitlegroup as $Titlegroupp)
														@if ($Titlegroupp->titlegroup_id == $Titlegroup->id)
															selected 
														@endif 
													@endforeach
														value="{{ $Titlegroup->id }}">{{ $Titlegroup->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <p class="mg-b-10">انتخاب گروه ها</p>
                                            <select name="Groups[]" class="form-control select2" multiple="multiple">
                                                @foreach ($Groups as $Group)
                                                    <option
													@foreach ($GroupProducts as $GroupProduct)
													   @if ($GroupProduct->group_id == $Group->id)
														   selected 
													   @endif 
												   @endforeach value="{{ $Group->id }}">{{ $Group->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row row-sm mg-t-20">
                                        <div class="col-lg-12">
                                            <p class="mg-b-10">توضیحات محصول</p>
                                            <textarea class="form-control"  name="Description" placeholder="توضیحات مصحول را وراد کنید" rows="3">{{ $Product->Description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="col-lg-8">
                                            <div id="iput-add-VP">
												@foreach ($Product->SpecificationProducts() as $Specification)
												<div class="row row-vp border-input mt-2">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">ویژگی های محصول : </p>
                                                            <input value="{{ $Specification->Property  }}" name="Property[]" multiple class="form-control"
                                                                placeholder="مثال : وزن" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">مقدار ویژگی محصول : </p>
                                                            <input value="{{ $Specification->value  }}" name="value[]" multiple class="form-control"
                                                                placeholder="مثال : 234 گرم" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 div-remove-icone">
                                                        <ion-icon class="click-remove remove-icone"
                                                            name="close-outline"></ion-icon>
                                                    </div>
                                                </div>
												@endforeach
                                            </div>
                                            <div class="input-group mb-3 mt-2">
                                                <a id="click-add" class="btn ripple btn-info me-1 text-w">اضافه کردن
                                                    ویژگی</a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="id-Product" value="{{ $Product->id }}"
                                        name="id">
                                    <button type="button"
                                        class="btn ripple btn-primary me-1 DSP-Product float-left nextBtn" style="margin-top: 4.3rem;"
                                        onclick="nextPrev(1)">بعدی</button>
                                </form>

                            </div>
                            <!-- form-wizard-page-6 -->
                            <div class="tab bg-Form">
                                <center>
                                    <h3>تائید محصول</h3>
                                </center>
                                <div class="row row-sm mt-3">
                                    <form action="{{ route('acceptshowProduct') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row row-sm">
                                            <div class="col-md-6 col-lg-6 col-xl-4 col-sm-6"></div>
                                            <div id="Product-show" class="col-md-6 col-lg-6 col-xl-4 col-sm-6">

                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-4 col-sm-6"></div>
                                        </div>
                                        <input type="hidden" class="id-Product" value="{{ $Product->id }}"
                                            name="id">
                                        <button type="submit" value="add-image"
                                            class="btn ripple btn-success me-1 accept-Product float-left nextBtn" style="margin-top: 4.3rem;">تائید</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 mt-2">
                            <button type="button" id="prevBtn" class="btn ripple btn-primary float-right"
                                onclick="nextPrev(-1)">قبلی</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
@section('script')
    <!-- Jquery-Ui js-->
    <script src="{{ loadA('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

    <!-- Internal Jquery.maskedinput js-->
    <script src="{{ loadA('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>

    <!-- Internal Specturm-colorpicker js-->
    <script src="{{ loadA('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>

    <!-- Internal Ion-rangeslider js-->
    <script src="{{ loadA('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Wizard Form js-->
    <script src="{{ loadA('assets/js/Custom/WizardForm.js') }}"></script>

    <!-- Internal Form-elements js-->
    <script src="{{ loadA('assets/js/form-elements.js') }}"></script>

    <!-- Internal Parsley js-->
    <script src="{{ loadA('assets/plugins/parsleyjs/parsley.min.js') }}"></script>

    <!-- Internal Form-validation js-->
    <script src="{{ loadA('assets/js/form-validation.js') }}"></script>

    <!-- Internal Fileuploads js-->
    <script src="{{ loadA('assets/plugins/fileuploads/js/fileupload.js ') }}"></script>
    <script src="{{ loadA('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

    <!-- filepond css-->
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const inputElement = document.getElementById('fileupload');
        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: ["image/*"],
            labelIdle: "تصاویر محصول رو وارد کنید",
        });
        FilePond.setOptions({
            server: {
                process: '/temp/upload/Product/img',
                revert: '/temp/delete/Product/img',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },
        });
    </script>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.Product-insert', function() {
                var errorAlert =
                    '<div class="alert alert-outline-danger mg-b-0" role="alert"><button aria-label="بستن" class="close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">×</span></button><strong>خطا ! </strong>شما هیچ رنگی انتخاب نکردید</div>'
                $(".loader-div").show();
                $.ajax({
                    data: $('#Product-form').serialize(),
                    url: "{{ route('insertProduct') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        if (data !== false) {
                            $(".alert").remove();
                            $(".CPN-inputs").remove();
                            $("#CPN").append(data.CPN);
                            $(".Title-form").text('قیمت و تعداد محصول');
                            $(".Title-form").removeClass('alert-danger');
                            $('.Product-insert').addClass('Product-update');
                            $('.Product-insert').removeClass('Product-insert');
                            $(".loader-div").hide();
                        } else {
                            $(".alert").remove();
                            $(".CPN-inputs").remove();
                            $("#CPN").append(errorAlert);
                            $("#nextBtn").attr('disabled', 'true');
                            $(".Title-form").text('خطا !');
                            $(".Title-form").addClass('alert-danger');
                            $(".loader-div").hide();
                        }
                    },
                })
            });
            $('body').on('click', '.Product-update', function() {
                var errorAlert = '<div class="alert alert-outline-danger mg-b-0" role="alert"><button aria-label="بستن" class="close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">×</span></button><strong>خطا ! </strong>شما هیچ رنگی انتخاب نکردید</div>'
                $(".loader-div").show();
                $.ajax({
                    data: $('#Product-form').serialize(),
                    url: "{{ route('UpdateProduct') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        if (data !== false) {
                            $(".alert").remove();
                            $(".CPN-inputs").remove();
                            $("#CPN").append(data.CPN);
                            $(".Title-form").text('قیمت و تعداد محصول');
                            $(".Title-form").removeClass('alert-danger');
                            $(".loader-div").hide();
                        } else {
                            $(".alert").remove();
                            $(".CPN-inputs").remove();
                            $("#CPN").append(errorAlert);
                            $("#nextBtn").attr('disabled', 'true');
                            $(".Title-form").text('خطا !');
                            $(".Title-form").addClass('alert-danger');
                            $(".loader-div").hide();
                        }
                    },
                })
            });
            $('body').on('click', '.CPN-Product', function() {
                $.ajax({
                    data: $('#Product-CPN').serialize(),
                    url: "{{ route('SetCPN') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $(".loader-div").hide();
                    },
                })
            });
            $('body').on('click', '.DSP-Product', function() {
                $(".loader-div").show();
                $.ajax({
                    data: $('#Product-DSP').serialize(),
                    url: "{{ route('SetDSP') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $(".Product-show-accept").remove();
                        $("#Product-show").append(data.Product_show);
                        $('.dropify-render img').attr('src',data.img)
                        $(".loader-div").hide();
                    },
                })
            });
            
            $('body').on('click', '.btnDeleteimg', function() {
                var id = $('.btnDeleteimg').data('id');
                $(".loader-div").show();
                $.ajax({
                    data: {'id':id},
                    url: "{{ route('Delimages') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.error(data.success);
                        $(".Products-image").remove();
                        $(".Products-images").append(data.images);
                        $(".loader-div").hide();
                    },
                })
            });
            
            
            $('#Product-images').on('submit',function(event){
                event.preventDefault();
                $.ajax({
                    url: "{{ route('Setimages') }}",
                    method:"POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $(".img-old").remove();
                        $(".Products-images").append(data.images);
                    },
                })
            });
            $('#prevBtn').click(function() {
                $('.nextBtn').removeAttr('disabled');
            });
            $('#click-add').click(function() {
                $('#iput-add-VP').append(
                    '<div class="row row-vp border-input mt-2"><div class="col-md-6"><div class="form-group"><p class="mg-b-10">ویژگی های محصول :</p><input name="Property[]" multiple="multiple" class="form-control" placeholder="مثال : وزن" type="text"></div></div><div class="col-md-6"><div class="form-group"><p class="mg-b-10">مقدار ویژگی محصول :</p><input name="value[]" multiple="multiple" class="form-control" placeholder="مثال : 234 گرم" type="text"></div></div><div class="col-lg-1 div-remove-icone"><ion-icon class="click-remove remove-icone" name="close-outline"></ion-icon></div></div>'
                    )
            })
            $('body').on('click', '.click-remove', function() {
                $(".row-vp").last().remove();
            });
        });
        document.getElementById('Discount').onchange = function() {
            document.getElementById('Discount_number').disabled = !this.checked;
            document.getElementById('StartDiscount').disabled = !this.checked;
            document.getElementById('EndDiscount').disabled = !this.checked;
        };
        document.getElementById('suggested').onchange = function() {
            document.getElementById('Startsuggested').disabled = !this.checked;
            document.getElementById('Endsuggested').disabled = !this.checked;
        };
    </script>
@endsection