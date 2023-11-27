@extends('Admin.Layout.Home')
@section('Content')
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">ویرایش رنگ محصول</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a>محصولات</li>
                <li class="breadcrumb-item"> لیست محصولات </li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش رنگ محصول</li>
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
                                <span class="step">1</span><span class="text-form-wizard">انتخاب رنگ های محصول</span>
                                <span class="step">2</span><span class="text-form-wizard">تعداد و قیمت محصول</span>
                            </center>
                        </div>
                        <div class="col-12 borderr form-wizard-1 mt-4 mb-5">
                            <!-- form-wizard-page-1 -->
                             <div class="tab">
                                <center>
                                    <h3>ویرایش رنگ های مصحول</h3>
                                </center>
                                <form id="Colors-form">
                                    <div class="row row-sm">
                                        <div class="col-lg-12 form-group">
                                            <label class="form-label">رنگ های مورد نظر برای محصول را انتخاب کنید : <span
                                                    class="tx-danger">*</span></label>
                                            @foreach ($Colors as $Color)
                                                <label class="colorinput"><input
                                                        @foreach ($Product->ColorNumberPrice() as $Colors)  @if ($Colors->Color()->id == $Color->id) checked  @endif @endforeach
                                                        name="Colors[]" value="{{ $Color->id }}" type="checkbox"
                                                        class="colorinput-input required">
                                                    <span style="background-color:{{ $Color->Color }};"
                                                        class="colorinput-color border"></span></label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $Product->id }}">
                                    <button type="button"
                                        class="btn ripple btn-primary me-1 float-left Set-Colors nextBtn" style="margin-top: 4.3rem;"
                                        onclick="nextPrev(1)">بعدی</button>
                                </form>
                            </div>
                            <!-- form-wizard-page-2 -->
                            <div class="tab">
                                <center>
                                    <h3 class="Title-form">قیمت و تعداد محصول</h3>
                                </center>
                                <form id="Product-CPN" method="POST" action="{{ route('SetCPN') }}">
                                    @csrf
                                    <div id="CPN"></div>
                                    <input type="hidden" class="id-Product" value="{{ $Product->id }}"
                                        name="id">
                                    <button type="submit" class="btn ripple btn-primary me-1 float-left" style="margin-top: 4.3rem;">تائید</button>
                                </form>
                            </div>
                        </div>
                        <div class="mb-2 mt-2">
                            <button type="button" id="prevBtn" class="btn ripple btn-primary float-right" onclick="nextPrev(-1)">قبلی</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
@section('script')
    <!-- Wizard Form js-->
    <script src="{{ loadA('assets/js/Custom/WizardForm.js') }}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click', '.Set-Colors', function() {
                var errorAlert = '<div class="alert alert-outline-danger mg-b-0" role="alert"><button aria-label="بستن" class="close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">×</span></button><strong>خطا ! </strong>شما هیچ رنگی انتخاب نکردید</div>'
                $(".loader-div").show();
                $.ajax({
                    data: $('#Colors-form').serialize(),
                    url: "{{ route('SetColorProduct') }}",
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
            $("#Product-CPN").submit(function(){
                $(".loader-div").show();
            });
            $('#prevBtn').click(function() {
                $('.nextBtn').removeAttr('disabled');
            });
        });
    </script>
@endsection