@extends('Home.Layout.Shipping')
@section('Content')
<section class="page-shipping">
    <div class="page-row">
        <div class="col-12 text-center">
            <div class="complate-page-container">
                <div class="success-checkout">
                    <div class="container">
                        <div class="icon-success">
                            <span class="fa fa-check"></span>
                        </div>
                        <div class="order-success">
                            سفارش 
                            <a href="#" class="order-code">{{ $ordernumber }}</a>
                            با موفقیت پرداخت و در سیستم ثبت شد.
                            <span class="order-ready-post">پرداخت با موفقیت انجام شد. سفارش شما با موفقیت ثبت شد و در زمان تعیین شده برای شما ارسال خواهد شد.
                            <br>
                            از اینکه دیجی استور را برای خرید انتخاب کردید از شما سپاسگزاریم.
                            </span>
                            <center>
                                <a href="{{ route('index') }}">
                                    <button class="dk-btn dk-btn-info">
                                        رفتن به صفحه اصلی 
                                   </button>
                                </a>
                            </center>
                        </div>
                    </div>   
                </div>

                <div class="checkout-order-info">
                    <div class="order-info">
                        <div class="order-code">
                           کد سفارش :
                            <span>{{ $ordernumber }}</span>
                        </div>
                        <div class="checkout-process-order-info">
                            سفارش شما با موفقیت در سیستم ثبت شد و هم اکنون 
                            <a href="#" class="processing">در حال پردازش</a>
                             است.جزئیات این سفارش را می توانید
                                 با کلیک بر روی دکمه 
                            <a href="#" class="link-border">پیگیری سفارش</a>
                                 مشاهده نمایید.
                        </div>
                        <div class="parent-btn btn-following-order">
                            <button class="dk-btn dk-btn-info">
                                 پیگیری سفارش
                                <i class="fa fa-shopping-bag sign-in"></i>
                            </button>
                        </div>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col"> نام تحویل گیرنده : {{ $Basket->Addres()->Name }}</th>
                              <th scope="col">شماره تماس : {{ $Basket->Addres()->Mobile }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>تعداد مرسوله :  ({{ CPB($ProductsBasket) }})</td>
                              <td>مبلغ کل : {{ number_format(SumBasket($ProductsBasket)) }}</td>
                            </tr>
                            <tr>
                              <td>وضعیت پرداخت : پرداخت آنلاین(موفق)</td>
                              <td>وضعیت سفارش : {{ StatusBakset($Basket) }}</td>
                            </tr>
                            <tr>
                              <td>آدرس : {{ $Basket->Addres()->Address }}</td>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

      

     