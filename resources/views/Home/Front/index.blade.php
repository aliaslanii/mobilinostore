@extends('Home.Layout.Home')
@section('Content')
 <!--slider--------------------------------->
 <article class="container-fluid">
    <div class="page-row-main-top">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="main-slider-container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 slider-image" src="{{ asset('images/Home-image/'.getHomeimg(11)) }}">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 slider-image" src="{{ asset('images/Home-image/'.getHomeimg(12)) }}">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 slider-image" src="{{ asset('images/Home-image/'.getHomeimg(13)) }}">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100 slider-image" src="{{ asset('images/Home-image/'.getHomeimg(14)) }}">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                        data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <!--    slider--------------------------------->
        <!--adplacement-------------------------------->
    </div>
</article>
<article class="container-main">
    <!--    product-slider------------------------->
    <div class="col-lg-9 col-md-9 col-xs-12 pull-right">
        <div class="section-slider-product mb-4 mt-3">
            <div class="widget widget-product card">
                <header class="card-header">
                    <span class="title-one">محبوب ترین ها</span>
                    <h3 class="card-title">مشاهده همه</h3>
                </header>
                <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                            @foreach ($Products as $Product)
                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">
                                    <div class="item">
                                        <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">
                                            <img src="{{ asset('images/Products-image/' . $Product->img) }}" class="img-fluid">
                                        </a>
                                        <h2 class="post-title">
                                            <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">
                                                {{ $Product->title }}
                                            </a>
                                        </h2>
                                        <div class="price">
                                            @if (CheckDiscount($Product))
                                            <center>
                                                <del>{{ number_format(CheapestPrice($Product)) }}<span>تومان</span></del>
                                                <ins><span>{{ number_format(DiscountedPrice($Product->id, Color($Product)->id)) }}<span>تومان</span></span></ins>
                                            </center>
                                            <div class="stars-plp Discount-Product">
                                                <span class="price-currency Discount-Product-number">%{{ $Product->Discounts()->Discount_number }}</span>
                                            </div>
                                            @else
                                            <center>
                                                <ins><span>{{ number_format(DiscountedPrice($Product->id, Color($Product)->id)) }}<span>تومان</span></span></ins>
                                            </center>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    product-slider------------------------->
    <!--slider-sidebar----------------------------->
    <div class="col-lg-3 col-md-3 col-xs-12 pull-left">
        <div class="promo-single mb-4 mt-3">
            <div class="widget-suggestion widget card">
                <header class="card-header cart-sidebar">
                    <h3 class="card-title ts-3">فروش ویژه</h3>
                </header>
                <div id="progressBar">
                    <div class="slide-progress" style="width: 100%; transition: width 5000ms ease 0s;"></div>
                </div>
                
                <div id="suggestion-slider" class="owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                    
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(1369px, 0px, 0px); transition: all 0.25s ease 0s; width: 2190px;">
                            @foreach ($SsuggestionsProduct as $Product)
                                @if (CheckSuggestions($Product))
                                    <div class="owl-item" style="width: 273.75px;">
                                        <div class="item">
                                            <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">
                                                <img src="{{ asset('images/Products-image/' . $Product->img) }}" class="w-100" alt="">
                                            </a>
                                            <h3 class="product-title">
                                                <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">
                                                    {{ $Product->title }}
                                                </a>
                                            </h3>
                                            <div class="price mt-4">
                                                @if (CheckDiscount($Product))
                                                <center>
                                                    <del>{{ number_format(CheapestPrice($Product)) }}<span>تومان</span></del>
                                                    <strong><span>{{ number_format(DiscountedPrice($Product->id, Color($Product)->id)) }}<span>تومان</span></span></strong>
                                                </center>
                                                <div class="stars-plp Discount-Product">
                                                    <span class="price-currency Discount-Product-number">%{{ $Product->Discounts()->Discount_number }}</span>
                                                </div>
                                                @else
                                                <center>
                                                    <span>{{ number_format(DiscountedPrice($Product->id, Color($Product)->id)) }}<span>تومان</span></span>
                                                </center>
                                                @endif                                               
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
                    </div>
                    <div class="owl-dots disabled"></div>
                    
                </div>
               
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="adplacement-container-row mb-4">
            <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding-left:0;">
                <a href="#" class="adplacement-item mb-4">
                    <div class="adplacement-sponsored-box">
                        <img src="{{ asset('images/Home-image/'.getHomeimg(21)) }}" alt="گوشی ها پرچم دار"
                            title="گوشی ها پرچم دار">
                    </div>
                </a>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-12 pull-right" style="padding-left:0;">
                <a href="#" class="adplacement-item mb-4">
                    <div class="adplacement-sponsored-box">
                        <img src="{{ asset('images/Home-image/'.getHomeimg(22)) }}" alt="گوشی های دو سیم کارت"
                            title="گوشی های دو سیم کارت">
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--slider-sidebar----------------------------->

    <!--        category--------------------------->
    <div class="col-12">
        <div class="promotion-categories-container mb-4">
            <h3 class="promotion-categories-title">دسته بندی کالا های موبالینو</h3>
            <div class="category-container">
                <div class="promotion-categories">
                    @foreach (Categorysindex() as $Category)
                    <a href="{{ route('SearchCategory',['id' => $Category->id]) }}" class="promotion-category">
                        <img src="{{ asset('images/Category-image/'.$Category->img) }}">
                        <div class="promotion-category-name">{{ $Category->Name }}</div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--        category--------------------------->

    <!--    product-slider----------------------------------->
    <div class="col-lg-12 col-md-12 col-xs-12 pull-right">
        <div class="section-slider-product mb-4">
            <div class="widget widget-product card">
                <header class="card-header">
                    <span class="title-one">جدیدترین ها</span>
                    <h3 class="card-title">مشاهده همه</h3>
                </header>
                <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                            @foreach ($newProducts as $Product)
                            <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">
                                <div class="item">
                                    <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">
                                        <img src="{{ asset('images/Products-image/' . $Product->img) }}" class="img-fluid">
                                    </a>
                                    <h2 class="post-title">
                                        <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">
                                            {{ $Product->title }}
                                        </a>
                                    </h2>
                                    <div class="price">
                                        @if (CheckDiscount($Product))
                                        <center>
                                            <del>{{ number_format(CheapestPrice($Product)) }}<span>تومان</span></del>
                                            <span>{{ number_format(DiscountedPrice($Product->id, Color($Product)->id)) }}<span>تومان</span></span>
                                        </center>
                                        <div class="stars-plp Discount-Product">
                                            <span class="price-currency Discount-Product-number">%{{ $Product->Discounts()->Discount_number }}</span>
                                        </div>
                                        @else
                                            <center>
                                                <span>{{ number_format(DiscountedPrice($Product->id, Color($Product)->id)) }}<span>تومان</span></span>
                                            </center>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <div class="col-12">
        <div class="promotion-categories-container mb-4">
            <h3 class="promotion-categories-title">برند های مختلف با محصولات بی نظیر</h3>
            <div class="category-container">
                <div class="promotion-categories">
                    @foreach (Berands() as $Berands)
                    <a href="{{ route('SearchBerands',['id' => $Berands->id]) }}" class="promotion-category">
                        <img src="{{ asset('images/Berands-image/'.$Berands->img) }}">
                        <div class="promotion-category-name">{{ $Berands->Name }}</div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--    product-slider------------------------->
    <div class="col-12">
        <div class="promotion-categories-container mb-4">
            <h3 class="promotion-categories-title">گوشی برای نیاز شما</h3>
            <div class="category-container mb-3">
                <div class="col-sm-12 col-md-3 col-lg-3 pull-right mb-4" style="padding-left:0;">
                    <a href="#" class="adplacement-item mb-4">
                        <div class="adplacement-sponsored-box">
                            <img src="{{ asset('images/Home-image/'.getHomeimg(31)) }}" style="border-radius: 2rem;"">
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 pull-right mb-4" style="padding-left:0;">
                    <a href="#" class="adplacement-item mb-4">
                        <div class="adplacement-sponsored-box">
                            <img src="{{ asset('images/Home-image/'.getHomeimg(32)) }}" style="border-radius: 2rem;"">
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 pull-right mb-4" style="padding-left:0;">
                    <a href="#" class="adplacement-item mb-4">
                        <div class="adplacement-sponsored-box">
                            <img src="{{ asset('images/Home-image/'.getHomeimg(33)) }}" style="border-radius: 2rem;"">
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 pull-right mb-4" style="padding-left:0;">
                    <a href="#" class="adplacement-item mb-4">
                        <div class="adplacement-sponsored-box">
                            <img src="{{ asset('images/Home-image/'.getHomeimg(34)) }}" style="border-radius: 2rem;"">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--    adplacemen-container----------------------------->
    
    <!--    adplacemen-container----------------------------->
</article>
@endsection
@section('script')
<script>
    $(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $('body').on("click" , ".Likebtn" ,function() {
			var product_id = $(this).data("product_id");
			$.ajax({
				data: {'product_id': product_id},
				url: "{{ route('AddFavirate') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.Likebtn').attr('hidden','true');
					$('.DisLikebtn').removeAttr('hidden');
				}
			});
		});
		$('body').on("click" , ".DisLikebtn" ,function() {
			var product_id = $(this).data("product_id");
			$.ajax({
				data: {'product_id': product_id},
				url: "{{ route('removeFavirate') }}",
				type: "POST",
				dataType: 'json',
				success: function (data) {
					$('.DisLikebtn').attr('hidden','true');
					$('.Likebtn').removeAttr('hidden');
				}
			});
		});
    });
</script>
@endsection