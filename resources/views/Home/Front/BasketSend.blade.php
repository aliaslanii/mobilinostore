@extends('Home.Layout.Profile') @section('Content')
    <div class="col-xl-9 col-lg-8 col-md-12 order-2">
        <div class="row">
            <div class="col-lg-12">
                <header class="card-header">
                    <h3 class="card-title">
                        <span>تحویل داده شده</span>
                    </h3>
                </header>
                <div class="content-section default">
                    <div class="row">
                        @foreach ($Baskets as $Basket)
                            <div class="col-md-12 col-sm-12 order_delivered_sec">
                                <div class="profile-recent-fav-row">
                                    <div class="col-12">
                                        <h4 class="profile-recent-fav-name">
                                            <ion-icon class="icon-basket-send" name="checkmark-circle-outline"></ion-icon>
                                            <span>تحویل داده شده</span>
                                        </h4>
                                        <ul>
                                            <li> {{ verta($Basket->updated_at)->format('%d %B %Y' . ' ساعت :' . ' H:i') }}
                                            </li>
                                            <li> کد سفارش <b>{{ $Basket->ordernumber }}</b>
                                            <li> مجموع سبد <b>{{ number_format(Basketinvoice($Basket)->SumPrice) }}</b></li>
                                        </ul>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            @foreach ($Basket->BasketsProducts() as $BasketsProducts)
                                                <div class="col-4 col-lg-2 col-md-2">
                                                    <img  src="{{ asset('images/Products-image/' . $BasketsProducts->Products()->img) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 text-left">
                                        <a href="{{ route('Generateinvoice',['id' => Basketinvoice($Basket)->id ]) }}" class="btn btn-main-masai">مشاهده فاکتور</a>
                                        <a href="{{ route('Downloadinvoice',['id' => Basketinvoice($Basket)->id ]) }}" class="btn btn-main-masai">دانلود فاکتور</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
