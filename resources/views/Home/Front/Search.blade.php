@extends('Home.Layout.Home')
@section('Content')
    <!--search------------------------------------->
    <div class="container-main">
        <div class="col-12">
            <div class="breadcrumb-container">
                <ul class="js-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('index') }}" class="breadcrumb-link">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="breadcrumb-link">جست و جو</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="breadcrumb-link active-breadcrumb">{{ $q }}</a>
                    </li>
                </ul>
            </div>
        </div>
        @if (count($Products) > 0)
        <div class="col-lg-12 col-md-12 col-xs-12 pull-left">
            <article class="listing-wrapper-tab">
                <div class="listing">
                    <ul class="listing-items p-5">
                        <li style="display:block;">
                            @foreach ($Products as $Product)
                            <div class="col-lg-3 col-md-4 col-xs-12 border-Produc pull-right mb-3 ml-2 ">
                                <div class="product-vertical">
                                    <div class="vertical-product-thumb">
                                        <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">
                                            <img src="{{ asset('images/Products-image/' . $Product->img) }}">
                                        </a>
                                    </div>
                                    <div class="card-vertical-product-content">
                                        <div class="card-vertical-product-title">
                                            <a target="_blank" href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">
                                                {{ $Product->title }}
                                            </a>
                                        </div>
                                        @if (CheckDiscount($Product))
                                        <div class="card-vertical-product-price" style="font-size: 1.1rem">
                                            {{ number_format(DiscountedPrice($Product->id, Color($Product)->id)) }}<span class="price-currency">تومان</span>
                                        </div>
                                        <div class="card-vertical-product-price">
                                            <del>{{ number_format(CheapestPrice($Product)) }}<span class="price-currency">تومان</span></del>
                                            <div class="stars-plp Discount-Product">
                                                <span
                                                    class="price-currency Discount-Product-number">{{ $Product->Discounts()->Discount_number }}%</span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="card-vertical-product-price" style="font-size: 1.1rem">
                                            {{ number_format(DiscountedPrice($Product->id, Color($Product)->id)) }}<span class="price-currency">تومان</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <center>
                                    <a target="_blank" class="text-white btn btn-primary mb-3" 
                                href="{{ route('ShowProduct', ['P_id' => $Product->P_id, 'Name' => $Product->Name, 'Color' => Color($Product)]) }}">مشاهده محصول</a>
                                </center>
                            </div>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </article>
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div dir class="col-md-4"> {{ $Products->links('Home.Layout.pagination') }}</div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-12 col-md-12 col-xs-12 pull-left">
            <div class="page-contents">
                <article class="listing-wrapper-tab">
                    <div class="listing mb-4">
                        <div class="listing-header" style="margin-top: 40px">
                            محصولی برای شما پیدا نشد
                        </div>
                    </div>
                </article>
            </div>
        </div>
        @endif
      
    </div>
    <!--search------------------------------------->
@endsection