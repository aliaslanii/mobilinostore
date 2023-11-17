@extends('Home.Layout.Profile')
@section('Content')
<div class="col-lg-9 col-md-9 col-xs-12 pull-left">
    <section class="page-contents">
        <div class="profile-content">
            <div class="headline-profile">
                <span>آدرس ها</span>
            </div>
            <div class="profile-stats">
                <div class="grid">
                    <div class="profile-address-container mt-3">
                        <button class="profile-address-add newAddress">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            افزودن آدرس جدید
                        </button>
                    </div>
                    <div id="address-section">
                        @foreach ($Address as $Addres)
                        <div class="profile-address-container user-address-container">
                            <div class="profile-address-card">
                                <div class="profile-address-card-desc">
                                    <h4 class="js-address-full-name">{{ $Addres->Name }}</h4>
                                    <p class="checkout-address-text">
                                        <span class="js-address-address-part">
                                            {{ $Addres->states()->State }} , {{ $Addres->cities()->City }} , {{ $Addres->Address }}
                                        </span>
                                    </p>
                                </div>
                                <div class="profile-address-card-data address-profile">
                                    <ul class="profile-address-card-methods">
                                        <li class="profile-address-card-method">
                                            <i class="fa fa-envelope-o"></i>
                                            کدپستی : 
                                            <span class="js-address-post-code">
                                                {{ $Addres->ZipCode }}
                                            </span>
                                        </li>
                                        <li class="profile-address-card-method">
                                            <i class="fa fa-mobile"></i>
                                            تلفن همراه :  
                                            <span class="js-address-post-code">
                                                {{ $Addres->Mobile }}
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="profile-address-card-actions">
                                        <button class="btn-note js-remove-address-btn removeaddress" data-id="{{ $Addres->id }}">حذف</button>
                                        <button class="btn-note js-edit-address-btn editAddress" data-id="{{ $Addres->id }}">ویرایش</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
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
        $('body').on("click",'.saveAddress', function() {
            $('.loader-div').show();
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
                    $('#address-section').remove();
                    $('.grid').append(data.HomeAddress);
                    $('#AddressModal').modal('hide');
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

		$('body').on('click', '.removeaddress', function() {
            $('.loader-div').show();
            var id = $(this).data('id');
			$.ajax({
				data: {'id': id},
				url: "{{ route('DeleteAddress') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
                    $('#address-section').remove();
                    $('.grid').append(data.HomeAddress);
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
	}); 
</script>
@endsection





