@extends('Admin.Layout.Home')
@section('Content')
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">ویرایش جزئیات محصول</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"></a>محصولات</li>
                <li class="breadcrumb-item"> لیست محصولات </li>
                <li class="breadcrumb-item active" aria-current="page">ویرایش جزئیات محصول</li>
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
                                <h3>ویرایش جزئیات محصول</h3>
                            </center>
                            <form action="{{ route('SetDSP') }}" id="Product-DSP" method="POST" enctype="multipart/form-data">
                                @csrf
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
                                            <a id="click-add" class="btn ripple btn-info me-1 text-w">اضافه کردن ویژگی</a>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $Product->id }}" name="id">
                                <button type="submit" class="btn ripple btn-primary me-1 float-left" style="margin-top: 4.3rem;"">تائید</button>
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

<script src="{{ loadA('assets/js/form-validation.js') }}"></script>
<script>
     $('#click-add').click(function() {
        $('#iput-add-VP').append(
            '<div class="row row-vp border-input mt-2"><div class="col-md-6"><div class="form-group"><p class="mg-b-10">ویژگی های محصول :</p><input name="Property[]" multiple="multiple" class="form-control" placeholder="مثال : وزن" type="text"></div></div><div class="col-md-6"><div class="form-group"><p class="mg-b-10">مقدار ویژگی محصول :</p><input name="value[]" multiple="multiple" class="form-control" placeholder="مثال : 234 گرم" type="text"></div></div><div class="col-lg-1 div-remove-icone"><ion-icon class="click-remove remove-icone" name="close-outline"></ion-icon></div></div>'
            )
    })
    $('body').on('click', '.click-remove', function() {
        $(".row-vp").last().remove();
    });
    $("#Product-DSP").submit(function(){
        $(".loader-div").show();
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