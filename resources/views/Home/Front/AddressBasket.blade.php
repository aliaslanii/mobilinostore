@extends('Home.Layout.Shipping')
@section('Content')
<!--shipping----------------------------------->
<section class="page-shipping">
    <div class="page-row">
        <div class="col-lg-8 col-md-8 col-xs-12 pull-right">
            <div class="shipment-page-container">
                <div class="headline-checkout">
                    <span>انتخاب آدرس تحویل سفارش</span>
                </div>
                <form action="{{ route('insertinfo') }}" method="POST" id="shipping-data-form">
                    @csrf
                    <div class="address-section">
                    @if($Addres)
                        <div class="checkout-contact Address-user">
                            <div class="checkout-contact-content">
                                <ul class="checkout-contact-items" style="display:inline-block;">
                                    <li class="checkout-contact-item checkout-contact-item-username"> گیرنده : 
                                        <span class="js-recipient-full-name">{{ $Addres->Name }}</span>
                                        <a href="javascript:void(0)" class="checkout-contact-edit editAddress" data-id="{{ $Addres->id }}" data-toggle="modal" data-target="#AddressModal">اصلاح این آدرس</a>
                                    </li>
                                    <li class="checkout-contact-item checkout-contact-item-location">
                                    <div class="checkout-contact-item checkout-contact-item-mobile">
                                        شماره تماس : 
                                        <span class="js-recipient-mobile-phone">{{ $Addres->Mobile }}</span>
                                    </div>
                                    <div class="checkout-contact-item-message">
                                        کد پستی :
                                        <span class="js-recipient-post_code">{{ $Addres->ZipCode }}</span>
                                    </div>
                                    <br>
                                    <span class="js-recipient-address-part">{{ $Addres->Address }}</span>
                                    </li>
                                    <input hidden name="Addres_id" value="{{ $Addres->id }}">
                                </ul>
                                <button class="checkout-contact-location" type="button" data-toggle="modal" data-target="#SelectAddress">تغییر آدرس ارسال</button>
                            </div>
                        </div>
                    @else
                        <div class="checkout-contact">
                            <div class="checkout-contact-content">
                                <ul class="checkout-contact-items" style="display:inline-block;">
                                    <li class="checkout-contact-item checkout-contact-item-username">
                                        <span class="js-recipient-full-name">آدرسی برای شما ثبت نشده است</span>
                                    </li>
                                </ul>
                                <a href="javascript:void(0)" class="checkout-contact-edit float-left newAddress">ایجاد آدرس ارسال</a>
                            </div>
                        </div>
                    @endif
                    </div>
                    <div class="checkout-contact">
                        <div class="checkout-contact-content">
                            <div class="form-legal-item">
                                <label for="#" class="form-legal-label mb-4">
                                    توضیحات سفارش : 
                                </label>
                                <textarea name="Description" cols="15" rows="5" class="ui-textarea-field form-control" placeholder="توضیحات تکمیلی سفارش"></textarea>
                            </div>
                        </div>
                    </div>                      
                    <div class="js-normal-delivery">
                        <div class="headline-checkout">
                            <span>انتخاب نحوه ارسال سفارش</span>
                        </div>
                        <div class="checkout-pack">
                            <div class="checkout-pack-header">
                                <div class="checkout-pack-header-title">
                                    <span>{{ CPB(bpu())  }} کالا</span>
                                    <div class="checkout-time-table-shipping-type">ارسال عادی</div>
                                </div>
                            </div>
                            <div class="checkout-pack-row">
                                @foreach (bpu() as $ProductBasket)
                                @if ($ProductBasket->count > 0)
                                    <section class="swiper-products-compact">
                                        <div class="swiper-slide">
                                            <div class="product-box">
                                                <a class="product-box-img">
                                                    <img src="{{ asset('images/Products-image/'. $ProductBasket->Products()->img) }}">
                                                </a>
                                                <div class="product-box-variant-color">
                                                    <span style="background-color: {{ $ProductBasket->Color()->Color }}"></span> {{ $ProductBasket->Color()->Name }}
                                                </div>
                                                <div>
                                                    <span><b>تعداد : </b></span> {{ $ProductBasket->count }}
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                @endif
                                @endforeach
                            </div>
                            <div class="checkout-pack-row js-shipment-submit-type">
                                <div class="checkout-shipment-invoice-type">
                                    <div class="form-auth-row">
                                        <label for="#" class="ui-checkbox">
                                            <input type="checkbox" value="1" name="login" id="remember">
                                            <span class="ui-checkbox-check"></span>
                                        </label>
                                        <label for="remember" class="remember-me">درخواست ارسال فاکتور خرید </label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                <div class="checkout-actions">
                    <a href="{{ route('BasketShow') }}" class="checkout-actions-back"><i class="fa fa-angle-right" aria-hidden="true"></i>بازگشت به سبد خرید</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
            <div class="page-aside">
                <div class="checkout-aside">
                    <div class="checkout-bill">
                        <ul class="checkout-bill-summary">
                            <li>
                                <span class="checkout-bill-item-title">قیمت کالاها({{ CPB(bpu()) }})</span>
                                <span class="checkout-bill-price">
                                    {{ number_format(SumBasket(bpu())) }}
                                    <span class="checkout-bill-currency">
                                        تومان
                                    </span>
                                </span>
                            </li>
                            <li>
                                <span class="checkout-bill-item-title">هزینه ارسال</span>
                                <span class="checkout-bill-item-title js-free-shipping">رایگان</span>
                            </li>
                            <li class="checkout-bill-total-price">
                                <span class="checkout-bill-total-price-title">مبلغ قابل پرداخت</span>
                                <span class="checkout-bill-total-price-amount">
                                    <span class="js-price">{{ number_format(SumBasket(bpu())) }}</span>
                                    <span class="checkout-bill-total-price-currency">تومان</span>
                                </span>
                                <div class="parent-btn">
                                    <button class="dk-btn dk-btn-info payment-link">
                                            ادامه فرآیند خرید
                                        <i class="mdi mdi-arrow-left"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>

<!--shipping----------------------------------->
<!-- AddressModal -->
<div class="modal fade" id="AddressModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">
             <i class="fa fa-map-marker" aria-hidden="true"></i>
             افزودن آدرس جدید
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <div class="middle-container middle-container-Addres">
                <form id="AddressForm" method="POST" class="form-checkout">
                  <div class="form-checkout-row">
                      <label for="name">نام تحویل گیرنده <span class="required-star" style="color:red;">*</span></label>
                      <input type="text" name="Name" required id="name" class="input-name-checkout form-control" placeholder="نام تحویل گیرنده را وارد نمایید">
                      <label for="phone-number">شماره موبایل <span class="required-star" style="color:red;">*</span></label>
                      <input type="text" name="Mobile" required id="phone-number" class="input-name-checkout form-control" placeholder="09xxxxxxxxx" style="text-align:left;">
                      <label for="fixed-number">شماره تلفن ثابت <span class="required-star" style="color:red;">*</span></label>
                      <input type="text" name="Phone" id="fixed-number" class="input-name-checkout form-control" placeholder="021xxxxxx" style="text-align:left;">
                      
                      <div class="form-checkout-valid-row">
                            <label for="city">استان 
                            <span class="required-star" style="color:red;">*</span></label>
                          <select name="State" class="form-control State">
                              <option value="date-desc" selected="selected">استان مورد نظر خود را انتخاب کنید </option>
                                @foreach ($States as $State)
                                    <option value="{{ $State->id }}" class="Select-State">{{ $State->State }}</option>
                                @endforeach
                          </select>
                          <label for="bld-num">پلاک<span class="required-star" style="color:red;">*</span></label>
                          <input type="text" name="Plate" id="bld-num" class="input-name-checkout js-input-bld-num form-control" placeholder="پلاک را وارد نمایید">
                      </div>
                      
                      <div class="form-checkout-valid-row">
                            <div class="Citys">
                                <div class="Select-City">
                                    <label for="city">شهر 
                                    <span class="required-star" style="color:red;">*</span></label>
                                    <select name="City" id="city" class="form-control">
                                        <option value="date-desc" selected="selected">شهر مورد نظر خود را انتخاب کنید</option>
                                    </select>
                                </div>
                            </div>
                          <label for="apt-id">واحد</label>
                          <input type="text" name="Unit" id="apt-id" class="input-name-checkout js-input-apt-id form-control" placeholder="واحد را وارد نمایید">
                      </div>
                      
                      <label for="post-code">کد پستی<span class="required-star" style="color:red;">*</span></label>
                      <input type="text" name="ZipCode" id="post-code" class="input-name-checkout form-control" placeholder="کد پستی را بدون خط تیره بنویسید">
                      
                      <label for="address">آدرس 
                      <span class="required-star" style="color:red;">*</span></label>
                      <input type="text" name="Address" id="address" class="input-name-checkout form-control" placeholder="آدرس خود را وارد نمایید" style="height:80px;">
                      
                      <div class="AR-CR">
                        <center>
                            <button type="button" value="create" class="btn-registrar saveAddress"> ثبت آدرس</button>
                        </center>
                      </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- End AddressModal -->

<!-- SelectAddress -->
<div class="modal fade" id="SelectAddress" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-map-marker" aria-hidden="true"></i>انتخاب آدرس </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body-Address" style="padding: 2rem">
                <div class="middle-container-Address">
                    @foreach ($Address as $Addres)
                    <div class="checkout-contact-content">
                        <ul class="checkout-contact-items" style="display:inline-block;">
                            <li class="checkout-contact-item checkout-contact-item-username"> گیرنده : 
                                <span class="js-recipient-full-name">{{ $Addres->Name }}</span>
                            </li>
                            <li class="checkout-contact-item checkout-contact-item-location">
                            <div class="checkout-contact-item checkout-contact-item-mobile">
                                شماره تماس : 
                                <span class="js-recipient-mobile-phone">{{ $Addres->Mobile }}</span>
                            </div>
                            <div class="checkout-contact-item-message">
                                کد پستی :
                                <span class="js-recipient-post_code">{{ $Addres->ZipCode }}</span>
                            </div>
                            <br>
                            <span class="js-recipient-address-part">{{ $Addres->Address }}</span>
                            </li>
                        </ul>
                        <a href="javascript:void(0)" data-id="{{ $Addres->id }}" class="checkout-contact-edit float-left SelectAddress">انتخاب آدرس</a>
                    </div>
                    <hr>
                    @endforeach
                    
                    <a href="javascript:void(0)" class="checkout-contact-edit float-left newAddress">ایجاد آدرس ارسال</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End SelectAddress -->

@endsection
@section('script')
<script>
	$(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(document).on('change', '.State', function() {
            $('.loader-div').show();
			var State = $(this).val();
			$.ajax({
				data: {'State': State},
				url: "{{ route('SelectStates') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.Select-City').remove();
                    $('.Citys').append(data.Citys);
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
        $('body').on("click",'.newAddress', function() {
            $('#SelectAddress').modal('hide');
            $('#AddressModal').modal('show');
            $('#AddressForm').trigger("reset");
            $.ajax({
				url: "{{ route('NewAddress') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
                    $('#AddressForm').remove(); 
                    $('.middle-container-Addres').append(data.AddressFormnew); 
				},
				error: function (data) {
					console.log('Error:', data);
				}
			}); 
		});
        $('body').on("click",'.saveAddress', function() {
            var value = $(this).parent().find('.saveAddress').val();
            if(value === 'create'){
                var adress = "{{ route('insertAddress') }}";
            }
            else{
                var adress = "{{ route('UpdatetAddress') }}";
            }
			$.ajax({
				data: $('#AddressForm').serialize(),
				url: adress,
				type: "POST",
				dataType: 'json',
				success: function (data) {
                    $('.checkout-contact').remove();
                    $('.address-section').append(data.AddressUser);
                    $('.middle-container-Address').remove();
                    $('.modal-body-Address').append(data.AddresSelect);
                    $('#AddressForm')[0].reset();
                    $('#AddressModal').modal('hide');
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
        $('body').on("click",'.SelectAddress', function() {
            $('.loader-div').show();
			var id = $(this).data('id');
			$.ajax({
				data: {'id': id},
				url: "{{ route('SelectAddress') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.Address-user').remove();
                    $('.address-section').append(data.AddressUser);
                    $('#SelectAddress').modal('hide');
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
        $('body').on("click",'.editAddress', function() {
            $('.loader-div').show();
            $('#AddressModal').modal('show');
			var id = $(this).data('id');
			$.ajax({
				data: {'id': id},
				url: "{{ route('editAddress') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
                    $('#AddressForm').remove();
                    $('.middle-container-Addres').append(data.AddressForm);
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
	}); 
</script>
@endsection