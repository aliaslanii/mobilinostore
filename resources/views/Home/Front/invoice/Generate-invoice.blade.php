<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>فاکتور فروش : {{ $invoice->Baskets()->Name }}</title>
<style>
      

    body {
        font-family: iranyekanweb, sans-serif; /* نام فونت اضافه شده در تنظیمات */
    }
    
    .img1{
        width: 5rem;float: left;left: 2rem;
    }
    .rtl{
        direction: rtl
    }
    html,
    body {
        margin: 10px;
        padding: 10px;
    }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    span,
    label {
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0px !important;
    }
    table thead th {
        height: 28px;
        text-align: left;
        font-size: 16px;
    }
    table,
    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 14px;
    }

    .heading {
        font-size: 24px;
        margin-top: 12px;
        margin-bottom: 12px;
    }
    .text-center
    {
        text-align:revert;
    }
    .small-heading {
        font-size: 18px;
    }
    .total-heading {
        font-size: 18px;
        font-weight: 700;
    }
    .size-start{
        font-size: 25px
    }
    .size-start2{
        font-size: 15px
    }
    .border-invoice{
        border: #d1d1d1 solid 2px;
        border-radius: 2rem;
    }
    .text-start {
        text-align: left;
    }
    .text-end {
        text-align: right;
    }
    .text-center {
        text-align: center;
    }
    .company-data span {
        margin-bottom: 4px;
        display: inline-block;
        font-size: 14px;
        font-weight: 400;
    }
    .no-border {
        border: 1px solid #fff !important;
    }
    .bg-blue {
        background-color: #e65959;
        color: #fff;
    }
</style>
</head>

<body dir="rtl">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 border-invoice">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center size-start ">بسمی تعالی </div>
                                    <div class="text-center size-start2">فاکتور فروش وب سایت موبایلینو</div>
                                </div>
                                <div class="col-md-4">
                                    <img class="img1"src="http://localhost/mobilinostore/public/images/logo/logo.png">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-5">
                                    <div class="mb-2 text-end">شماره فاکتور : {{ $invoice->invoicnumber }}</div>
                                    <div class="mb-2 text-end"> تاریخ ثبت فاکتور : {{ verta($invoice->created_at)->format('%d %B %Y') }}</div>
                                    <div class="mb-2 text-end"> زمان ثبت فاکتور : {{ verta($invoice->created_at)->format('ساعت :' . ' H:i') }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <table class="order-details rtl">
                                        <thead>
                                            <tr class="bg-blue">
                                                <td class="text-center">نام محصول</td>
                                                <td class="text-center">قیمت واحد محصول</td>
                                                <td class="text-center">تعداد</td>
                                                <td class="text-center">جمع</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice->invoiceProducts() as $Products)
                                                <tr>
                                                    <td class="text-end">{{ $Products->Products()->title }}</td>
                                                    <td class="text-center">{{ $Products->Price }}</td>
                                                    <td class="text-center">{{ $Products->Number }}</td>
                                                    <td class="text-center">{{ $Products->Price * $Products->Number }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-5">
                                        <div class="mb-1 text-end">قیمت  : {{ $invoice->SumPrice}}</div>
                                        <div class="mb-1 text-end">- مقدار تخفیف : 0</div>
                                        <div class="mb-1 text-end">قیمت کل : {{ $invoice->SumPrice}}</div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="text-end mb-3">
                              <span> آدرس : </span>{{ $invoice->Baskets()->Addres()->Address }}
                            </div>
                            <div class="text-end mb-3">
                                <span> توضیحات : </span>{{ $invoice->Baskets()->Description }}
                              </div>
                            <p class="text-start mb-3">
                                با تشکر از خرید شما
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>