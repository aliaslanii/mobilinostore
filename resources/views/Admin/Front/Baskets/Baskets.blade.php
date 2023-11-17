@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">لیست سبد خرید</h2> 
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>سبد های خرید</li>

         @if (request()->is('admin/Baskets/paydone'))
            <li class="breadcrumb-item active" aria-current="page">لیست  سبد های پرداخت شده </li>
         @elseif (request()->is('admin/Baskets'))
            <li class="breadcrumb-item active" aria-current="page">لیست تمامی سبد ها </li>
         @elseif (request()->is('admin/Baskets/send'))
            <li class="breadcrumb-item active" aria-current="page">لیست  سبد های ارسال شده </li>
         @elseif (request()->is('admin/Baskets/cancel'))
            <li class="breadcrumb-item active" aria-current="page">لیست  سبد های لغو شده </li>
         @endif
  
      </ol>
   </div>
</div>
<!-- End Page Header -->
<!-- Row -->
<div class="row row-sm">
   <div class="col-xl-2">
   </div>
   <div class="col-xl-8 col-lg-12 col-md-12">
      <div class="card custom-card">
         <div class="card-body">
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="orders" role="tabpanel">
                  <div class="d-flex mb-4">
                   <label class="main-content-label my-auto">لیست سبد خرید</label>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-Berand">
                        <thead>
                        <tr>
                           <th>#</th>
                           <th>نام مشتری</th>
                           <th>شماره سفارش</th>
                           <th>وضعیت سفارش</th>
                           <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-2">
   </div>
</div>
<!--End Row -->
<!-- Form Modal BasketsShow -->
<div class="modal" id="BasketShowModel">
   <div class="modal-dialog modal-xl BasketsProducts">   
   </div>
</div>
<!-- End Form Modal BasketsShow -->

<!-- Form Modal ConfirmDelete -->
<div class="modal" id="ConfirmDelete">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
            <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
         </div>
         <div class="modal-body">
            <div class="row row-sm">
               <div class="col-md-12">
                  <h5 class="modal-title mb-4 text-center">از لغو کردن سبدخرید اطمینان دارید ؟</h5>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="javascript:void(0)" class="btn ripple btn-primary btnCloseModel">بیخیال !</a>
            <a href="javascript:void(0)" class="btn ripple btn-danger" id="AcceptBasketscancel">لغو سبد</a>
         </div>
      </div>
   </div>
</div>
<!-- End Form Modal ConfirmDelete -->
@endsection
@section('script')
<script type="text/javascript">
     $(function() {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      var table = $('.data-table-Berand').DataTable({
         processing: true,
         serverSide: true,
         "language": {
            "info": "نمایش _START_ تا _END_ از _TOTAL_ نتیجه",
            "sSearch" : "جست و جو : ",
            "sProcessing": "درحال بارگذاری ...",
            "sLengthMenu": "نمایش _MENU_ اطلاعات",
            "sLoadingRecords": "بارگذاری ....",
            "spolite": "نمایش _START_ تا _END_ از _TOTAL_ نتیجه",
            "sInfoFiltered": "(نتیجه جست و جو شما از  _MAX_ اطلاعات)",
            "sZeroRecords" : "هیچ اطلاعاتی برای جست و جو شما پیدا نشد",
            "sInfoEmpty" : "نمایش رکوردها از 0 تا 0 از مجموع 0 رکورد",
            "oPaginate": {
               "sFirst": "اولین",
               "sLast": "آخرین",
               "sNext": "بعدی",
               "sPrevious": "قبلی"
            },
         },
         ajax: "{{ $route }}",
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'User', name: 'User'},
            {data: 'ordernumber', name: 'ordernumber'},
            {data: 'Status', name: 'Status', orderable: true, searchable: false},
            {data: 'action', name: 'action', orderable: true, searchable: false},
         ]
      });
      $('.table').removeClass('dataTable');

      $('body').on('click', '.Basketscancel', function () {
         var id = $(this).data("id");
         $('#ConfirmDelete').modal('show');
         $('#AcceptBasketscancel').attr("data-id",id);
      });   

      $('#AcceptBasketscancel').click(function(){
         $(".loader-div").show();
         var id = $(this).data("id");
         $.ajax({
            data:{'id':id },
            url: "{{ route('Basketcancel') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $('#ConfirmDelete').modal('hide');
               $(".loader-div").hide();
               table.draw();
            },
         });
      }); 

      $('body').on('click', '.BasketsShow', function () {
         $(".loader-div").show();
         var id = $(this).data("id");
         $('#BasketShowModel').modal('show');
         $.ajax({
            data:{'id':id },
            url: "{{ route('BasketsShow') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $(".table-BasketsProducts").remove();
               $(".BasketsProducts").append(data.BasketsShow);
               $(".loader-div").hide();
            },
         })
      });    

      $('body').on('click', '.send-Basket', function () {
         $(".loader-div").show();
         var id = $(this).data("id");
         $('#BasketShowModel').modal('show');
         $.ajax({
            data:{'id':id },
            url: "{{ route('ExitBasket') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $('#BasketShowModel').modal('hide');
               $(".loader-div").hide();
               table.draw();
            },
         })
      });
      $('body').on('click', '.btnCloseModel', function () {
         $('#BasketShowModel').modal('hide');
         $('#ConfirmDelete').modal('hide');
      });
   });     
</script>
@endsection