@extends('Home.Layout.Shipping')
@section('Content')
<!--shipping----------------------------------->
<section class="page-shipping">
    <div class="page-row">
        <div class="col-lg-8 col-md-8 col-xs-12 pull-right">
            <div class="shipment-page-container">
                <section class="page-content">
                    <div class="payment">
                        <div class="payment-payment-types">
                            <div class="payment-header">
                                <span>
                                    شیوه پرداخت
                                </span>
                            </div>
                            <ul class="payment-paymethod">
                                <li>
                                    <div class="payment-paymethod-item">
                                        <label for="#" class="outline-radio">
                                            <input type="radio" name="payment_method" id="payment-option-online" checked="checked">
                                            <span class="outline-radio-check"></span>
                                        </label>
                                        <label for="#" class="payment-paymethod-title-row">
                                            <div class="payment-paymethod-title">      پرداخت اینترنتی</div>
                                            <div class="payment-paymethod-dsc">آنلاین با تمامی کارت‌های بانکی</div>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="payment-paymethod-item">
                                        <label for="#" class="outline-radio">
                                            <input type="radio" name="payment_method" id="payment-option-online">
                                            <span class="outline-radio-check"></span>
                                        </label>
                                        <label for="#" class="payment-paymethod-title-row">
                                            <div class="payment-paymethod-title">      پرداخت اعتباری</div>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="payment-voucher">
                            <div class="payment-voucher-header">
                                <button class="btn btn-block text-right collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                   کارت هدیه و کد تخفیف
                                    <i class="mdi mdi-chevron-down"></i>
                                    <div class="payment-voucher-header"></div>
                                </button>
                            </div>
                            <div class="payment-gift-card-list">
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                                    <div class="payment-voucher-input-row">
                                        <label for="payment-voucher-input" class="payment-serial-input-label">کد تخفیف</label>
                                        <div class="payment-serial-input-container">
                                            <input type="text" class="payment-serial-input form-control" id="payment-voucher-input" placeholder="افزودن کد تخفیف">
                                            <button class="payment-serial-button">اعمال</button>
                                        </div>
                                    </div>
                                    <div class="payment-voucher-input-row">
                                        <label for="payment-voucher-input" class="payment-serial-input-label">کارت هدیه</label>
                                        <div class="payment-serial-input-container">
                                            <input type="text" class="payment-serial-input form-control" id="payment-voucher-input" placeholder="افزودن کارت هدیه جدید">
                                            <button class="payment-serial-button">اعمال</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-summary">
                            <div class="payment-header">
                               <span>خلاصه سفارش</span>
                            </div>
                            <section class="payment-summary-item">
                                <div class="payment-summary-row-header">
                                    <button class="btn btn-block text-center collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="payment-summary-col">
                                        مرسوله ۱
                                        <span>
                                            ({{ CPB(bpu()) }})
                                            کالا
                                        </span>
                                    </div>
                                    <div class="payment-summary-col payment-summary-col-package-amount">
                                        <span>مبلغ مرسوله : </span>
                                        <div class="payment-summary-price">
                                            {{ number_format(SumBasket(bpu())) }}
                                            <span>تومان</span>
                                        </div>
                                    </div>
                                    <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                </div>
                                
                                    <section class="payment-summary-swiper">
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    @foreach (bpu() as $ProductBasket)
                                                        @if ($ProductBasket->count > 0)
                                                    <div class="product-box">
                                                        <a href="#" class="product-box-img">
                                                            <img src="{{ asset('images/Products-image/'. $ProductBasket->Products()->img) }}">
                                                        </a>
                                                        <div class="product-box-swiper-title">
                                                            {{ $ProductBasket->Products()->title }}
                                                        </div>
                                                        <div class="product-box-variant">
                                                            <span style="background-color: {{ $ProductBasket->Color()->Color }}"></span> {{ $ProductBasket->Color()->Name }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                
                            </section>
                        </div>
                    </div>
                </section>
                <div class="checkout-actions">
                    <a href="#" class="checkout-actions-back"><i class="fa fa-angle-right" aria-hidden="true"></i>بازگشت به سبد خرید</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
            <div class="page-aside">
                <div class="checkout-aside">
                    <div class="checkout-bill">
                        <ul class="checkout-bill-summary">
                            <li>
                                <span class="checkout-bill-item-title">قیمت کالاها(۱)</span>
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
                                    <span class="js-price"> {{ number_format(SumBasket(bpu())) }}</span>
                                    <span class="checkout-bill-total-price-currency">تومان</span>
                                </span>
                                <div class="parent-btn">
                                    <a href="{{ route('PaymentBasket') }}">
                                        <button class="dk-btn dk-btn-info payment-link">
                                            ادامه فرآیند خرید
                                       <i class="mdi mdi-arrow-left"></i>
                                         </button>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--shipping----------------------------------->
@endsection