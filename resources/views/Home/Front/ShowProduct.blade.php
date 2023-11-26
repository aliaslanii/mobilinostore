@extends('Home.Layout.Home')
@section('link')
<!--  fancybox-------------------------------->
<link rel="stylesheet" href="{{ load('assets/css/fancybox.min.css') }}">
@endsection
@section('Content')
<!--single-product----------------------------->
<div class="container-main">
	<div class="col-12">
		<div class="breadcrumb-container">
			<ul class="js-breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ route('index') }}" class="breadcrumb-link">خانه</a>
				</li>
				<li class="breadcrumb-item">
					<a href="#" class="breadcrumb-link">{{ $Product->Categories()->Name }}</a>
				</li>
				<li class="breadcrumb-item">
					<a href="#" class="breadcrumb-link">{{ $Product->Berand()->Name }}</a>
				</li>
				<li class="breadcrumb-item">
					<a href="#" class="breadcrumb-link active-breadcrumb">{{ $Product->Name }}</a>
				</li>
			</ul>
		</div>
		<article class="product">
			<div class="col-lg-4 col-xs-12 pb-5 pull-right">
					<!-- Product Options-->
					<ul class="gallery-options">
						@if (Auth::user())
						<li>
							<div class="DisLike" @if(checkfp($Product->id) != true) hidden="true" @endif>
								<button class="options-item DisLikebtn" data-product_id="{{ $Product->id }}"><ion-icon class="icone" style="color: red" name="heart"></ion-icon></button>
								<span class="tooltip-option">حذف از علاقمندی</span>	
							</div> 
							<div class="Like" @if(checkfp($Product->id) == true) hidden="true" @endif>
								<button class="options-item Likebtn" data-product_id="{{ $Product->id }}"><ion-icon class="icone" name="heart-outline"></ion-icon></button>
								<span class="tooltip-option">افزودن به علاقمندی</span>
							</div> 
						</li>
						<li>
							<button id="Saherbtn" class="options-item" type="button" ><ion-icon class="icone" name="share-social-outline"></ion-icon></button>
							<span class="tooltip-option">اشتراک گذاری</span>
						</li>
						@else
						<li class="mt-5">
							<button id="Saherbtn" class="options-item" type="button" ><ion-icon class="icone" name="share-social-outline"></ion-icon></button>
							<span class="tooltip-option">اشتراک گذاری</span>
						</li>
						@endif
					</ul>
					<div class="product-gallery">
						<span class="badge">پر فروش</span>
						<div class="product-gallery-carousel owl-carousel">
							<div class="item">
								<a class="gallery-item" href="{{ asset('images/Products-image/' . $Product->img) }}"
									data-fancybox="gallery1" data-hash="one">
									<img src="{{ asset('images/Products-image/' . $Product->img) }}" alt="Product">
								</a>
							</div>
							@foreach ($Product->Images() as $img)
								<div class="item">
									<a class="gallery-item" href="{{ asset('images/Products-image/' . $img->img) }}"
										data-fancybox="gallery1" data-hash="two">
										<img src="{{ asset('images/Products-image/' . $img->img) }}" alt="Product">
									</a>
								</div>
							@endforeach
						</div>
						<ul class="product-thumbnails">
							<li class="active">
								<a href="#one">
									<img src="{{ asset('images/Products-image/' . $Product->img) }}" alt="Product">
								</a>
							</li>
							@foreach ($Product->Images() as $img)
							<li>
								<a href="#two">
									<img src="{{ asset('images/Products-image/' . $img->img) }}" alt="Product">
								</a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			<div class="col-lg-8 col-xs-12 pull-right">
				<section class="product-info">
					<div class="product-headline">
						<h1 class="product-title">
							{{ $Product->title }}
						</h1>
					</div>
					<div class="product-attributes">
						<div class="col-lg-6 col-xs-12 pull-right">
							<div class="product-config">
								<div class="product-config-wrapper">
									<div class="product-directory">
										<ul>
											<li>
												<span>برند</span>
												:
												<a href="#" class="product-brand-title">{{ $Product->Berand()->Name }}</a>
											</li>
										</ul>
									</div>
									
									<div class="product-variants">
										</ul>
										<span>انتخاب رنگ: </span>
										<ul class="js-product-variants">
											@foreach ($Product->ColorNumberPrice() as $Colors)
												@if ($Colors->number > 0)
													<li class="ui-variant">
														<label  class="ui-variant-color setColor" data-p-id="{{ $Product->id }}" data-c-id="{{ $Colors->Color()->id }}">
															<span class="ui-variant-shape" style="background-color: {{ $Colors->Color()->Color }}"></span>
															<input type="radio" name="color" class="js-variant-selector " @if ($Colors->Color()->id == $Color) checked="" @endif>
															<span class="ui-variant-check">{{ $Colors->Color()->Name }}</span>
														</label>
													</li>
												@endif
											@endforeach
										</ul>
									</div>
									<div class="product-params">
										<ul>ویژگی‌های محصول
											@php $count = 0 @endphp
											@foreach ($Product->SpecificationProducts() as $Specification)
												@if($count < 3)
													<li>
														<span>{{ $Specification->Property }} : </span>
														<span>{{ $Specification->value }}</span>
													</li>
												@else
													<li class="product-params-more">
														<span>{{ $Specification->Property }} : </span>
														<span>{{ $Specification->value }}</span>
													</li>
												@endif
												@php $count ++ @endphp
											@endforeach
											<li class="product-params-more-handler">
												<a href="#" class="more-attr-button">
													<span class="show-more">+ موارد بیشتر</span>
													<span class="show-less">- بستن</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-5 col-xs-12 pull-left">
							<div class="product-summary">
								<div class="product-seller-info">
									<div class="seller-info-changable">
										<div class="product-seller-row vendor">
											<span class="title"> فروشنده :</span>
											<a href="#" class="product-name">موبالینو</a>
										</div>
										<div class="product-seller-row guarantee">
											<span class="title"> گارانتی :</span>
											<a href="#" class="product-name">۱۸ ماهه موبالینو</a>
										</div>
										@if ($Product->SumNumber > 0)
										<div>
											<div class="product-seller-row price">
												<div class="product-seller-price-info price-value mb-3">
													<span class="title"> قیمت :</span>
													@if (CheckDiscount($Product))
													<span class="amount ms-5"><del id="Price">{{ number_format($ColorNumberPrice->price) }}</del></span>
													<span class="amount text-danger ml-3"> تومان</span><span id="Price-Discount" class="amount text-danger ml-1">{{ number_format(DiscountedPrice($Product->id,$Color)) }}</span>
													@else
													<span class="amount text-danger ml-3"> تومان</span><span id="Price" class="amount text-danger ml-3">{{ number_format(DiscountedPrice($Product->id,$Color)) }}</span>
													@endif
												</div>
											</div>
											<div @if($fpb != null) hidden="true" @endif id="add-baket-btn"  class="parent-btn">
												@if (Auth::user())
													<button type="button"  data-p-id="{{ $Product->id }}" data-c-id="{{ $Color }}"
													type="button" id="addBasket" class="dk-btn dk-btn-info at-c as-c">افزودن به سبد خرید<i class="mdi mdi-cart"></i>
													</button>
												@else
													<a href="{{ route('login') }}">
														<button type="button"type="button" class="dk-btn dk-btn-info at-c as-c">
															افزودن به سبد خرید<i class="mdi mdi-cart"></i>
														</button>
													</a>
												@endif
												
											</div>
											<div @if($fpb == null) hidden="true" @endif id="PM-basket-btn" class="parent-btn borderr">
												<form id="ProductColor">
													<input type="hidden" name="Color" id="Color" value="{{ $Color }}">
													<input type="hidden" name="Product" value="{{ $Product->id }}">
													<a id="Pluscount" class="btn btn-add-to-cart @if(Auth::user()) @if(PCB($Product->id,$Color,getBasketuser()) == true) disabled @endif @endif">
														<ion-icon class="icone-ar" name="add-circle"></ion-icon>
													</a>
													<span id="countP" class="amount ms-5"> @if($fpb != null) {{ $fpb->count }} @endif </span>
													<a id="Minuscount" class="btn btn-add-to-cart">
														<ion-icon class="icone-ar" name="remove-circle"></ion-icon>
													</a>
												</form>
											</div>
										</div>
										@else
											<div>		
												<div id="add-baket-btn"  class="parent-btn">
													<button class="dk-btn dk-btn-info product-stock-action">ناموجود	
													<i class="fa fa-bell"></i></button>
												</div>				
											</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</article>
	</div>
<!--    product-slider----------------------------------->
<div class="col-lg-12 col-md-12 col-xs-12 pull-right">
    <div class="section-slider-product mb-4">
        <div class="widget widget-product card">
            <header class="card-header">
                <span class="title-one">محصولات مرتبط</span>
                <h3 class="card-title">مشاهده همه</h3>
            </header>
            <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
				<div class="owl-stage-outer">
					<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
						@foreach ($Products as $item)
						<div class="owl-item active" style="width: 309.083px; margin-left: 10px;">
							<div class="item">
								<a target="_blank" href="{{ route('ShowProduct', ['P_id' => $item->P_id, 'Name' => $item->Name, 'Color' => Color($item)]) }}">
									<img src="{{ asset('images/Products-image/' . $item->img) }}" class="img-fluid">
								</a>
								<h2 class="post-title">
									<a target="_blank" href="{{ route('ShowProduct', ['P_id' => $item->P_id, 'Name' => $item->Name, 'Color' => Color($item)]) }}">
										{{ $item->title }}
									</a>
								</h2>
								<div class="price">
									@if (CheckDiscount($item))
									<del>{{ number_format(CheapestPrice($item)) }}<span>تومان</span></del>
									<ins><span>{{ number_format(DiscountedPrice($item->id, Color($item)->id)) }}<span>تومان</span></span></ins>
									<div class="stars-plp Discount-Product">
										<span
											class="price-currency Discount-Product-number">%{{ $item->Discounts()->Discount_number }}</span>
									</div>
									@else
									<ins><span>{{ number_format(DiscountedPrice($item->id, Color($item)->id)) }}<span>تومان</span></span></ins>
									@endif
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i
                            class="fa fa-angle-right"></i></button><button type="button" role="presentation"
                        class="owl-next"><i class="fa fa-angle-left"></i></button></div>
                <div class="owl-dots disabled">
                </div>
                <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i
                            class="fa fa-angle-right"></i></button><button type="button" role="presentation"
                        class="owl-next"><i class="fa fa-angle-left"></i></button></div>
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
</div>
<!--    product-slider------------------------->
<div class="col-12">
	<div class="tabs mt-4 pt-3 mb-5">
		<div class="tabs-product">
			<div class="tab-wrapper">
				<ul class="box-tabs">
					<li class="box-tabs-tab tabs-active">
						<a href="javascript:void(0)" class="box-tab-item">
						<i class="mdi mdi-glasses"></i>
						نقد و بررسی</a>
					</li>
					<li class="box-tabs-tab">
						<a href="javascript:void(0)" class="box-tab-item">
						<i class="mdi mdi-format-list-checks"></i>
						مشخصات</a>
					</li>
					<li class="box-tabs-tab">
						<a href="javascript:void(0)" class="box-tab-item">
						<i class="mdi mdi-comment-text-multiple-outline"></i>
						نظرات کاربران</a>
					</li>
				</ul>
			</div>
			<div class="tabs-content">
				<div class="content-expert">
					<section class="tab-content-wrapper" style="display:block;">
						<article>
							<h2 class="params-headline">نقد و بررسی 
								<span>{{ $Product->title }}</span>
							</h2>
							<section class="content-expert-summary">
								<div class="mask pm-3">
									<div class="mask-text">
										<p>{{ $Product->Description }}</p>
									</div>
									<a href="#" class="mask-handler">
										<span class="show-more">+ ادامه مطلب</span>
										<span class="show-less">- بستن</span>
									</a>
									<div class="shadow-box"></div>
								</div>
							</section>
							
						</article>
					</section>
					<section class="tab-content-wrapper">
						<article>
							<h2 class="params-headline">مشخصات فنی
								<span>{{ $Product->title }}</span>
							</h2>
							<section>
								<h3 class="params-title">مشخصات کلی</h3>
								<ul class="params-list">
									@foreach ($Product->SpecificationProducts() as $Specification)
									<li class="params-list-item">
										<div class="params-list-key">
											<span class="block">{{ $Specification->Property }} </span>
										</div>
										<div class="params-list-value">
											<span class="block">
												 {{  $Specification->value  }}
											</span>
										</div>
									</li>
									@endforeach
								</ul>
							</section>
						</article>
					</section>
					<section class="tab-content-wrapper">
						<div class="comments">
							<h2 class="comments-headline">نظرات کاربران به :
								<span>
									{{ $Product->title }}
								</span>
							</h2>
							<div class="comments-summary">
								<div class="comments-summary-note">
									<p>
										برای ثبت نظر، لازم است ابتدا وارد حساب کاربری خود شوید. اگر این محصول را قبلا از موبالینو خریده باشید،
										نظر
										شما به عنوان مالک محصول ثبت خواهد شد.
									</p>
									<div class="parent-btn lr-ds">
										@if (Auth::user())
											<button class="dk-btn dk-btn-info"  aria-modal="CommentModal" data-toggle="modal" data-target="#CommentModal">
												افزودن نظر جدید
												<i class="mdi mdi-comment-text-multiple-outline"></i>
											</button>
										@endif
									</div>
								</div>       
							</div>
						</div>
					@foreach ($Comments as $Comment)
						<section class="comment-body">
							<div class="col-lg-4 col-md-4 col-xs-12 pull-right">
								<div class="aside">
									<ul class="comments-user-shopping pt-1">
										<li class="mb-3">
											<div class="cell cell-name">{{ $Comment->User()->name }}</div>
										</li>
										<li>
											<div class="cell">
												{{ verta($Comment->created_at)->format('%d %B %Y') }}
											</div>
										</li>
									</ul>
									@if ($Comment->Viewpoint == 1)
										<div class="text-success"><span class="fa fa-thumbs-o-up icon-Viewpoint"></span>خرید این محصول را توصیه می‌کنم</div>
									@elseif($Comment->Viewpoint == 2)
										<div class="text-danger"><span class="fa fa-thumbs-o-down icon-Viewpoint"></span>خرید این محصول را توصیه نمیکنم</div>
									@elseif($Comment->Viewpoint == 0)
										<div class="text-info"><span class="fa fa-exclamation icon-Viewpoint"></span> درباره خرید این محصول اطمینان ندارم !</div>
									@endif
								</div>
							</div>
							<div class="col-lg-8 col-md-8 col-xs-12 pull-left">
								<div class="article">
									<div class="header">
										<div>{{ $Comment->Subject }}</div>
									</div>
									<p style="width: 47rem;">{{ $Comment->Description }}</p>
									<div class="comments-evaluation">
										<div class="comments-evaluation-positive">
											<span>نقاط قوت</span>
											<ul>
												@foreach (pointPlus($Comment) as $Plus)
												<li>
													{{ $Plus->plus }}
												</li>
												@endforeach
											</ul>
										</div>
										<div class="comments-evaluation-negative">
											<span>نقاط ضعف</span>
											<ul>
												@foreach (pointMinus($Comment) as $Minus)
												<li>
													{{ $Minus->minus }}
												</li>
												@endforeach
											</ul>
										</div>
									</div>
								</div>
							</div>
						</section>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!--single-product----------------------------->
<!-- ShearModal -->
<div class="modal fade" id="ShearModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalCenterTitle">اشتراک گذاری محصول</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="middle-container">	
				<div class="form-checkout">
					<div class="form-checkout-row">
						<p id="textToCopy">{{ url()->current()}}</p>
						<button id="copyButton" type="button" class="btn-registrar"><ion-icon  name="copy-outline"></ion-icon></button>
					</div>
				</div>
			</div>
		</div>
	  </div>
	</div>
</div>
<!-- End ShearModal -->



<!-- ShearModal -->
<div class="modal" id="CommentModal" aria-modal="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title">دیدگاه شما</h6><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="addCommentForm">
					<section class="product-comment">
						<div class="comments-product">
							<div class="comments-product-row">
								<div class="comments-add">
									<div class="comments-add-row">
										<div class="col-lg-6 col-md-6 col-xs-12 pull-right">
											<div class="form-comment p-4">
												<div class="form-ui">
													<form class="px-5">
														<div class="row">
															<div class="col-12 mt-3" style="margin-bottom: 6rem">
																<div class="form-row-title mb-2">میزان رضایت</div>
																<div class="form-row">
																	<label class="container-comment" style="right: 19.5rem">
																		<center><span class="comment-title select-title">پیشنهاد میکنم</span></center>
																		<input value="1" type="radio" name="Viewpoint">
																		<span class="fa fa-thumbs-o-up checkmark select-title border-comment"></span>
																	</label>
																	<label class="container-comment" style="right: 12.5rem">
																		<center><span class="comment-title select-title">نظری ندارم</span></center>
																		<input value="0" type="radio" name="Viewpoint">
																		<span class="fa fa-exclamation checkmark select-title border-comment" style="padding-right: 2.4rem;"><span>
																	</label>
																	<label class="container-comment" style="right: 5.5rem">
																		<center><span class="comment-title select-title">پیشنهاد نمی کنم</span></center>
																		<input value="2" type="radio" name="Viewpoint">
																		<span class="fa fa-thumbs-o-down checkmark select-title border-comment"></span>
																	</label>
																</div>
															</div>
															<div class="col-12 mt-3">
																<div class="form-row-title mb-2">عنوان نظر شما</div>
																<div class="form-row">
																	<input class="input-ui pr-2" type="text"
																		placeholder="عنوان نظر خود را بنویسید" id="Subject" required>
																</div>
															</div>
															<div class="col-12 mt-3">
																<div class="form-row-title mb-2">نکات مثبت</div>
																<div class="form-row">
																	<input class="input-ui pr-2 input-plus" type="text" placeholder="عنوان نظر خود را بنویسید">
																	<a class="add-Point-plus"><ion-icon class="icon-comment" name="add-outline"></ion-icon></a>
																	<div class="Positive-text">
																		
																	</div>
																</div>
															</div>
															<div class="col-12 mt-3">
																<div class="form-row-title mb-2">نکات منفی</div>
																<div class="form-row">
																	<input class="input-ui pr-2 input-minus" type="text" placeholder="عنوان نظر خود را بنویسید">
																	<a class="add-Point-minus"><ion-icon class="icon-comment" name="remove-outline"></ion-icon></a>
																	<div class="Negative-text">

																	</div>
																</div>
															</div>
															<div class="col-12 mt-3">
																<div class="form-row-title mb-2">متن نظر شما</div>
																<div class="form-row">
																	<textarea class="input-ui pr-2 pt-2" rows="5" id="Description"
																	required placeholder="متن خود را بنویسید" style="height:120px;"></textarea>
																</div>
															</div>
															<div class="col-12 mt-2 mb-2">
																<div class="product-offer-question">
																	<div class="product-offer-question-option">
																	</div>
																</div>
															</div>
															<br>
															<br>
															<br>
															<div class="col-12">
																<input type="hidden" data-p-id="{{ $Product->id }}" id="Product-id">
																<button type="button" id="saveComment" class="btn comment-submit-button commentbtn">ثبت نظر</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div> 
										<div class="col-lg-6 col-md-6 col-xs-12 pull-left">
											<div class="comments-add-col-content">
												<h4>دیگران را با نوشتن نظرات خود، برای انتخاب این محصول راهنمایی کنید.</h4>
												<p>لطفا پیش از ارسال نظر، خلاصه قوانین زیر را مطالعه کنید:</p><p>فارسی بنویسید و از کیبورد فارسی استفاده کنید. بهتر است از فضای خالی (Space)
												بیش‌از‌حدِ معمول، شکلک یا ایموجی استفاده نکنید و از کشیدن حروف یا کلمات با
												صفحه‌کلید بپرهیزید.</p><p>به کاربران و سایر اشخاص احترام بگذارید. پیام‌هایی که شامل محتوای توهین‌آمیز و
												کلمات نامناسب باشند، حذف می‌شوند.</p>
											</div>
										</div>      
									</div>
								</div>
							</div>
						</div>
					</section>
				</form>
			</div>		
		</div>
	</div>
</div>
<!-- End ShearModal -->

@endsection
@section('script')
<!--fancybox------------------------------------->
<script src="{{ load('assets/js/jquery.fancybox.min.js') }}"></script>
<!--countdown------------------------------------>
<script src="{{ load('assets/js/jquery.countdown.min.js') }}"></script>
<script>
$(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#Saherbtn').click(function(){
		$('#ShearModal').modal('show');
	});
	$("#copyButton").click(function () {
		var text = $("#textToCopy").text();
		var tempInput = $("<input>");
		$("body").append(tempInput);
		tempInput.val(text).select();
		document.execCommand("copy");
		tempInput.remove();
	});

	$('#addBasket').click(function() {
		$('.loader-div').show();
		$.ajax({
			data: $('#ProductColor').serialize(),
			url: "{{ route('AddProduct') }}",
			type: "POST",
			dataType: 'json',
			success: function (data) {
				$('.dropdownBasket').remove();
				$('.ProductsBasket').append(data.BasketProducts);
				$('#PM-basket-btn').removeAttr('hidden');
				$('#add-baket-btn').attr("hidden", "true");
				$('#countP').text(data.count);
				$('.loader-div').hide();
				if(data.error === true){
					$('#Pluscount').addClass('disabled');
				}
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
	});
	$('#Pluscount').click(function() {
		$('.loader-div').show();
		var color_id = $(this).data("c-id");
		$.ajax({
			data: $('#ProductColor').serialize(),
			url: "{{ route('Pluscount') }}",
			type: "POST",
			dataType: 'json',
			success: function (data) {
				$('.dropdownBasket').remove();
				$('.ProductsBasket').append(data.BasketProducts);
				$('#countP').text(data.count);
				$('.loader-div').hide();
				if(data.error === true){
					$('#Pluscount').addClass('disabled');
				}
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
	});
	$('#Minuscount').click(function(e) {
		$('.loader-div').show();
		var color_id = $(this).data("c-id");
		$.ajax({
			data: $('#ProductColor').serialize(),
			url: "{{ route('Minuscount') }}",
			type: "POST",
			dataType: 'json',
			success: function (data) {
				$('.dropdownBasket').remove();
				$('.ProductsBasket').append(data.BasketProducts);
				if(data.count === 0){
					$('#PM-basket-btn').attr("hidden","true");
					$('#add-baket-btn').removeAttr('hidden');
					$('#Pluscount').removeClass('disabled');
				}else{
					$('#countP').text(data.count);
					$('#Pluscount').removeClass('disabled');
				}
				
				
				$('.loader-div').hide();
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});
	});  
	$('.setColor').click( function () {
		var product_id = $(this).data("p-id");
		var color_id = $(this).data("c-id");
		$('.loader-div').show();
		$.ajax({
			data: {'Product': product_id,'Color': color_id },
			url: '{{ route("SelectColor") }}',
			type: "POST",
			dataType: 'json',
			success: function (data) {
				$('#Price').text(addCommas(data.Price));
				$('#countP').text(data.count);
				$('#Color').val(color_id);
				if(data.count === 0){
					$('#PM-basket-btn').attr("hidden","true");
					$('#add-baket-btn').removeAttr('hidden');
				}else{
					$('#add-baket-btn').attr("hidden","true");
					$('#PM-basket-btn').removeAttr('hidden');
				}
				if(data.PriceDiscount !== null){
					$('#Price-Discount').text(addCommas(data.PriceDiscount));  
				}
				if(data.error === true){
					$('#Pluscount').addClass('disabled');
				}
				else{
					$('#Pluscount').removeClass('disabled');
				}
				$('.loader-div').hide();
			},
			error: function (data) {
				console.error(data);
			},
		});
	});
	$('.Likebtn').click(function() {
		var product_id = $(this).data("product_id");
		$.ajax({
			data: {'product_id': product_id},
			url: "{{ route('AddFavirate') }}",
			type: "POST",
			dataType: 'json',
			success: function (data) {
				$('.Like').attr('hidden','true');
				$('.DisLike').removeAttr('hidden');
			}
		});
	});
	$('.DisLikebtn').click(function() {
		var product_id = $(this).data("product_id");
		$.ajax({
			data: {'product_id': product_id},
			url: "{{ route('removeFavirate') }}",
			type: "POST",
			dataType: 'json',
			success: function (data) {
				$('.DisLike').attr('hidden','true');
				$('.Like').removeAttr('hidden');
			}
		});
	});


	$('body').on("click",'.add-Point-plus',function () {
		var point = $('.input-plus').val();
		if (point !== '') {
			$('.loader-div').show();
			$.ajax({
				data:{'point' : point},
				url: '{{ route("AddPointplus") }}',
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.Positive-text').append(data.data);
					$('.input-plus').val("");
					$('.loader-div').hide();
				},
				error: function (data) {
					console.error(data.data);
					$('.loader-div').hide();
				},
			});
		}else{
			alert('متن نکته مثبت خالی است');
			$('.loader-div').hide();
		}
	});
	$('body').on("click",'.add-Point-minus',function () {
		var point = $('.input-minus').val();
		if (point !== '') {
			$('.loader-div').show();
			$.ajax({
				data:{'point' : point},
				url: '{{ route("AddPointminus") }}',
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.Negative-text').append(data.data);
					$('.input-minus').val("");
					$('.loader-div').hide();
				},
				error: function (data) {
					console.error(data.data);
					$('.loader-div').hide();
				},
			});
		} else {
			alert('متن نکته منفی خالی است');
			$('.loader-div').hide();
		}
	});
	
	$('#saveComment').click(function() {
		$('.loader-div').show();
		var Viewpoint = $("input[name='Viewpoint']:checked").val();
		var Product = $("#Product-id").data('p-id');
		var Subject = $("#Subject").val();
		var Description = $("#Description").val();
		var elementsplus = $(".text-plus");
		var plus = [];
		elementsplus.each(function(){
			var text = $(this).text();
			plus.push(text);
		});
		var elementsminus = $(".text-minus");
		var minus = [];
		elementsminus.each(function(){
			var text = $(this).text();
			minus.push(text);
		});
		$.ajax({
			data: {'Product' : Product,'Viewpoint' : Viewpoint ,'plus' : plus,'minus' : minus ,'Subject' : Subject , 'Description' : Description},
			url: "{{ route('insertCommentProduct') }}",
			type: "POST",
			dataType: 'json',
			success: function (data) {
				$('#CommentModal').modal('hide');
				$('.loader-div').hide();
			},
			error: function (data) {
				console.error(data);
				$('.loader-div').hide();
			}
		});
	});
	$('body').on("click",'.delete-point',function () {
		$(this).remove();
	});	
});	
</script>
@endsection