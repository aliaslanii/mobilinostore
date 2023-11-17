@extends('Home.Layout.Profile')
@section('Content')
<!--profile------------------------------------>
<div class="col-lg-9 col-md-9 col-xs-12 pull-left">
    <section class="page-contents">
        <div class="profile-content">
            <div class="headline-profile">
                <span>جزئیات سفارش‌ها</span>
            </div>
            <div class="profile-stats">
                <div class="profile-stats-row">
                    <div class="profile-stats page-profile-order">
                        <div class="table-orders">
                            @foreach ($Baskets as $Basket)
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">شماره سفارش</th>
                                        <th scope="col">تاریخ ثبت سفارش</th>
                                        <th scope="col">وضعیت سفارش</th>
                                        <th scope="col">مبلغ فاکتور</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="order-code">{{ $Basket->ordernumber }}</td>
                                        <td>{{ verta($Basket->created_at)->format('%d %B %Y' . ' ساعت :' . ' H:i') }}</td>

                                        <td class="text-success"><center>{{ StatusBakset($Basket) }}</center></td> 
                                        <td class="detail"><a class="text-center" href="profile-order-2.html" style="display:block;">{{ number_format(InvoiceBakset($Basket)->SumPrice) }}</a></td>
                                    </tr>
                                    <tr>
                                        @foreach ($Basket->BasketsProducts() as $BasketsProduct)
                                        <td><img class="img-Basket-Product" src="{{ asset('images/Products-image/'. $BasketsProduct->Products()->img) }}"></td>
                                        @endforeach
                                        <td></td>
                                    </tr>      
                                </tbody>
                            </table> 
                            <div class="middle-container "><div class="form-checkout"><div class="form-checkout-row">
                            <a href="{{ route('Downloadinvoice',['id' => $Basket->id]) }}" id="copyButton" class="btn-registrar float-left mb-2"">چاپ فاکتور</a></div></div></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!--        responsive-profile-order------------------------->
            <div class="profile-orders">
                <div class="collapse-orders">
                    <div class="profile-orders-item">
                        @foreach ($Baskets as $Basket)
                            <div class="profile-orders-header">
                                <a href="profile-order-2.html" class="profile-orders-header-details">
                                    <div class="profile-orders-header-summary">
                                        <div class="profile-orders-header-row">
                                            <span class="profile-orders-header-id">{{ $Basket->ordernumber }}</span>
                                            <span class="profile-orders-header-state">{{ StatusBakset($Basket) }}</span>
                                        </div>
                                    </div>
                                </a>
                                <hr class="ui-separator">
                                <div class="profile-orders-header-data">
                                    <div class="profile-info-row">
                                        <div class="profile-info-label">تاریخ ثبت سفارش</div>
                                        <div class="profile-info-value">{{ verta($Basket->created_at)->format('%d %B %Y' . ' ساعت :' . ' H:i') }}</div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-label">مبلغ کل</div>
                                        <div class="profile-info-value">{{ number_format(InvoiceBakset($Basket)->SumPrice) }}</div>
                                    </div>
                                    @foreach ($Basket->BasketsProducts() as $BasketsProduct)
                                       <img style="max-width: 25%;" src="{{ asset('images/Products-image/'. $BasketsProduct->Products()->img) }}">
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- responsive-profile-order------------------------->
        </div>
    </section>
</div>
@endsection
