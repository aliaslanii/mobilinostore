@extends('Home.Layout.Home')
@section('Content')
@if (checkBasket() == true)
<!--cart--------------------------------------->
<div id="Card">
	<div class="container-main Basketpage">
		<div class="col-12">
			<div class="breadcrumb-container">
				<ul class="js-breadcrumb">
					<li class="breadcrumb-item">
						<a href="#" class="breadcrumb-link">خانه</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#" class="breadcrumb-link active-breadcrumb">سبد خرید</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="page-content">
			<div class="cart-title-top">سبد خرید</div>
			<div class="cart-main">
				<div class="col-lg-9 col-md-9 col-xs-12 pull-right">
					<div class="title-content">
						<ul class="title-ul">
							<li class="title-item product-name">
								نام کالا
							</li>
							<li class="title-item required-number">
								تعداد
							</li>
							<li class="title-item unit-price">
								قیمت واحد
							</li>
							<li class="title-item total">
								مجموع
							</li>
						</ul>
					</div>
					@foreach (bpu() as $ProductBasket)
						@if ($ProductBasket->count > 0) 
							@if ($ProductBasket->Products()->SumNumber > 0)
							<div class="page-content-cart">
								<div class="checkout-body">
									<div class="product-name before">
										<a href="javascript:void(0)" data-p-id="{{ $ProductBasket->Products()->id}}" data-c-id="{{ $ProductBasket->Color()->id }}" class="btn removeProduct">
											<ion-icon name="trash-outline"></ion-icon>
										</a>
										<a href="{{ route('ShowProduct',['P_id' => $ProductBasket->Products()->P_id,'Color' => $ProductBasket->Color()->id , 'Name' =>$ProductBasket->Products()->Name]) }}" class="col-thumb mt-4">
											<img src="{{ asset('images/Products-image/'. $ProductBasket->Products()->img) }}">
										</a>
										<div class="checkout-col-desc">
											<a href="#">
												<h1>{{ $ProductBasket->Products()->title }}</h1>
											</a>
											<div class="checkout-variant-color">
												<span class="checkout-variant-title">{{ $ProductBasket->Color()->Name }}</span>
												<div class="checkout-variant-shape" style="background-color: {{ $ProductBasket->Color()->Color }}"></div>
												<div class="checkout-guarantee"><i class="fa fa-check"></i>گارانتی ۱۸ ماهه</div>
											</div>
										</div>
									</div>
									<div class="required-number before ProductNumber">
										<a data-p-id="{{ $ProductBasket->Products()->id}}" data-c-id="{{ $ProductBasket->Color()->id }}" class="btn btn-add-to-cart Pluscount
											@if(PCB($ProductBasket->Products()->id,$ProductBasket->Color()->id,getBasketuser()) == true) disabled @endif">
											<ion-icon class="icone-ar" name="add-circle"></ion-icon>
										</a>
										<span id="countP" class="amount ms-5 count-size">{{ $ProductBasket->count }}</span>
										<a data-p-id="{{ $ProductBasket->Products()->id}}" data-c-id="{{ $ProductBasket->Color()->id }}" class="btn btn-add-to-cart Minuscount">
											<ion-icon class="icone-ar" name="remove-circle"></ion-icon>
										</a>
									</div>
									<div class="unit-price before">
										<div class="product-price">
											@if ($ProductBasket->Products()->Discounts())
											<span class="amount ms-5">
												<del id="Price">{{ number_format(Price($ProductBasket->Products()->id,$ProductBasket->Color()->id)) }}</del>
											</span>
											<span id="Price-Discount" class="amount text-danger ml-3">
												{{ number_format(DiscountedPrice($ProductBasket->Products()->id,$ProductBasket->Color()->id)) }}<span> تومان</span>
											</span>
											@else
											<span id="Price" class="amount text-danger ml-3">
												{{ number_format(DiscountedPrice($ProductBasket->Products()->id,$ProductBasket->Color()->id)) }}<span> تومان</span>
											</span>
											@endif
										</div>
									</div>
									<div class="total before">
										<div class="product-price">
											{{ number_format(Sumrow($ProductBasket)) }}<span>تومان</span>
										</div>
									</div>
								</div>
							</div>
							@endif
						@endif
					@endforeach
				</div>
				<div class="col-lg-3 col-md-3 col-xs-12 pull-left">
					<div class="page-aside">
						<div class="checkout-summary">
							<div class="comment-summary mb-3">
								<p>هزینه این سفارش هنوز پرداخت نشده‌ و در صورت اتمام موجودی، کالاها از سبد حذف می‌شوند</p>
							</div>
							<div class="discount-code mb-4">
								<form action="#" class="discount-form">
									<label for="discount">کد تخفیف</label>
									<input type="text" id="discount" class="input-discount" placeholder="کد تخفیف خود را وارد کنید">
									<a href="#">
										<button class="btn-discount">اعمال</button>
									</a>
								</form>
							</div>
							<div class="discount-code mb-2">
								<form action="#" class="discount-form">
									<label for="discount">کد هدیه</label>
									<input type="text" id="discount" class="input-discount" placeholder="کد هدیه خود را وارد کنید">
									<a href="#">
										<button class="btn-discount">اعمال</button>
									</a>
								</form>
							</div>
							<div class="amount-of-payable mt-4">
								<span class="payable">مبلغ قابل پرداخت</span>
								<span class="amount-of">{{ number_format(SumBasket(bpu())) }}<span>تومان</span></span>
								<a href="{{ route('Addinfo') }}">
									<button class="setlement-account">تسویه حساب</button>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--cart--------------------------------------->
@else
<!--cart-empty--------------------------------->
<div class="container-main">
	<div class="col-12">
		<div class="cart-page">
			<div class="container">
				<div class="checkout-empty">
					<div class="checkout-empty-empty-cart-icon"></div>
					<div class="checkout-empty-title">سبد خرید شما خالی است!</div>
					<div class="col-lg-6 col-md-6!important col-xs-12 mx-auto">
						<div class="checkout-empty-links">
							<p>می‌توانید برای مشاهده محصولات بیشتر به صفحات زیر بروید</p>
							<div class="checkout-empty-link-urls">
								<a href="#">تخفیف‌ها و پیشنهادها</a>
								<a href="#">محصولات پرفروش روز</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--cart-empty--------------------------------->
@endif
@endsection

@section('script')
<script>
	$(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('body').on('click', '.Pluscount', function() {
            $('.loader-div').show();
			var color_id = $(this).data("c-id");
			var product_id = $(this).data("p-id");
			$.ajax({
				data: {'Product': product_id,'Color': color_id },
				url: "{{ route('Pluscount') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.dropdownBasket').remove();
                    $('.ProductsBasket').append(data.BasketProducts);
                    $('.Basketpage').remove();
					$('#Card').append(data.Card);
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
		
		$('body').on('click', '.Minuscount', function() {
            $('.loader-div').show();
			var color_id = $(this).data("c-id");
			var product_id = $(this).data("p-id");
			$.ajax({
				data: {'Product': product_id,'Color': color_id },
				url: "{{ route('Minuscount') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.dropdownBasket').remove();
                    $('.ProductsBasket').append(data.BasketProducts);
					$('.Basketpage').remove();
					$('#Card').append(data.Card);
                    $('.loader-div').hide();
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		});
		$('body').on('click', '.removeProduct', function() {
            $('.loader-div').show();
			var color_id = $(this).data("c-id");
			var product_id = $(this).data("p-id");
			$.ajax({
				data: {'Product': product_id,'Color': color_id },
				url: "{{ route('DeleteBasket') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.dropdownBasket').remove();
                    $('.ProductsBasket').append(data.BasketProducts);
                    $('.Basketpage').remove();
					$('#Card').append(data.Card);
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