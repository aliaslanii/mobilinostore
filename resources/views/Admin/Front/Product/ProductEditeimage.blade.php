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
                                <span class="step">3</span><span class="text-form-wizard">تصاویر مصحول</span>
                            </center>
                        </div>
                        <div class="col-12 borderr form-wizard-1 mt-4 mb-5">
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
									<a href="{{ route('Products') }}" 
										class="btn ripple btn-primary me-1 float-left nextBtn" style="margin-top: 4.3rem;">تائید</a>
								</form>
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
        });
    </script>
@endsection