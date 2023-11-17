<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>موبایلینواستور | پرداخت</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ load('assets/img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ load('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ load('assets/css/Dargah/pay.css') }}">
    <link rel="stylesheet" href="{{ load('assets/css/Dargah/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body dir="rtl" class="snippet-body">
    <div class="container p-0">
        <div class="card px-4 ">
            <p class="h8 py-3 Font-Shabnam">پرداخت سبد خرید</p>
            <form method="GET" action="{{ route('ChargeWallet') }}">
                @csrf
                <div class="row gx-3">
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">مبلغ پرداخت : {{ SumBasket(bpu()) }}</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">نام و نام خانوادگی</p>
                            <input class="form-control mb-3" type="text" value="{{ Auth::user()->name }}" placeholder="نام خود را وارد کنید">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">شماره کارت</p>
                            <input class="form-control mb-3" type="text" placeholder="شماره کارت خود را وارد کنید">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">تاریخ انقضا</p>
                            <input class="form-control mb-3" type="text" placeholder="ماه / سال">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">CVV2</p>
                            <input class="form-control mb-3 pt-2" type="password" placeholder="****">
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <button type="submit" class="btn btn-primary">پرداخت</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
</body>
</html>