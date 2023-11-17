@extends('Home.Layout.Profile')
@section('Content')
    <div class="col-xl-9 col-lg-8 col-md-12 order-2">
        <div class="row">
            <div class="col-lg-12">
                <header class="card-header">
                    <h3 class="card-title"><span>سفارشات لغو شده</span></h3>
                </header>
                <div class="content-section default">
                    <div class="row">
                        @foreach ($Baskets as $Basket)
                            <div class="col-md-6 col-sm-12 order_delivered_sec border">
                                <div class="col-12">
                                    <h4 class="profile-recent-fav-name">
                                        <ion-icon class="icon-basket-cancel" name="ban-outline"></ion-icon>
                                        <span>لغو شده</span>
                                    </h4>
                                    <ul>
                                        <li> {{ verta($Basket->updated_at)->format('%d %B %Y' . ' ساعت :' . ' H:i') }}
                                        </li>
                                        <li> کد سفارش <b>{{ $Basket->ordernumber }}</b>
                                        <li> مجموع سبد <b>{{ Basketinvoice($Basket)->SumPrice }}</b></li>
                                    </ul>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        @foreach ($Basket->BasketsProducts() as $BasketsProducts)
                                            <div class="col-4 col-lg-2 col-md-2">
                                                <img style="width: 4rem;"
                                                    src="{{ asset('images/Products-image/' . $BasketsProducts->Products()->img) }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 text-left">
                                    <a class="btn btn-main-masai">مشاهده جزئیات</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
