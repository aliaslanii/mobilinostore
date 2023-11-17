@extends('Admin.Layout.Home')
@section('Content')
<!-- Loader -->
<div class="loader-div">
   <div class="modal-loader"></div>
</div>
<!-- End Loader -->
 
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">لیست محصولات </h2> 
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>محصولات</li>
         <li class="breadcrumb-item active" aria-current="page"> لیست محصولات </li>
      </ol>
   </div>
</div>
<!-- End Page Header -->

<!-- Row -->
<div class="row row-sm">
   <div class="col-xl-1">
   </div>
   <div class="col-xl-10 col-lg-12 col-md-12">
      <div class="card custom-card">
         <div class="card-body">
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="orders" role="tabpanel">
                  <div class="d-flex mb-4">
                  <label class="main-content-label my-auto">لیست محصولات</label>
                  <h6 class="mb-0 mr-auto"><a href="{{ route('CreateProduct') }}"class="btn btn-primary float-right dropify-clear"><ion-icon class="m-top" name="add-circle-outline"></ion-icon></a></h6>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-Products">
                        <thead>
                        <tr>
                           <th>#</th>
                           <th>نام محصول</th>
                           <th>تصویر اصلی</th>
                           <th>دسته بندی</th>
                           <th>برند</th>
                           <th>تعداد</th>
                           <th class="td-details">جزئیات</th>
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
   <div class="col-xl-1">
   </div>
</div>
<!--End Row -->
<!-- Form Modal ConfirmDelete -->
<div class="modal" id="ConfirmDelete">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 class="modal-title mb-4 text-center">از حذف کردن محصول اطمینان دارید ؟</h5>
               <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                   <a href="javascript:void(0)" class="btn ripple btn-primary btnCloseModel">بیخیال !</a>
                   <a href="javascript:void(0)" class="btn ripple btn-danger me-1 AcceptDeleteProduct">حذف</a>
               </div>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal ConfirmDelete -->
<!-- ShowCPNModel -->
<div class="modal" id="ShowCPNModel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
            <h6 class="modal-title">جزئیات محصول</h6><a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
         </div>
         <div class="modal-body">
            <div class="row row-sm">
               <div id="data-CPN-Product"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--End ShowCPNModel -->


@endsection
@section('script')
<script type="text/javascript">
     $(function() {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      var table = $('.data-table-Products').DataTable({
         bAutoWidth:false,
         processing: true,
         serverSide: true,
         "language": {
            "info": "نمایش _START_ تا _END_ از _TOTAL_ نتیجه",
            "sSearch" : "جست و جو : ",
            "sProcessing": "درحال بارگذاری ...",
            "sLengthMenu": "نمایش _MENU_ اطلاعات",
            "sLoadingRecords": "بارگذاری ....",
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
         ajax: "{{ route('DefectiveProducts') }}",
         columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex'},
               {data: 'Name', name: 'Name'},
               {data: 'img', name: 'img' , orderable: true, searchable: false},
               {data: 'Category', name: 'Category'},
               {data: 'Berand', name: 'Berand'},
               {data: 'SumNumber', name: 'SumNumber'},
               {data: 'details', name: 'details'},
               {data: 'action', name: 'action', orderable: true, searchable: false},
      ]});
   $('.table').removeClass('dataTable');
   $('body').on('click', '.detailsProduct', function () {
      var id = $(this).data("id");
      $(".loader-div").show();
      $('#ShowCPNModel').modal('show');
      $.ajax({
         data:{'id':id },
         url: "{{ route('detailsProduct') }}",
         type: "POST",
         dataType: 'json',
         success: function (data) {
            $('#table-CPN-Product').remove();
            $('#data-CPN-Product').append(data);
            $(".loader-div").hide();
         },
      })
   }); 
   $('body').on('click', '.deleteProduct', function () {
         var id = $(this).data("id");
         $('#ConfirmDelete').modal('show');
         $('.AcceptDeleteProduct').attr("data-id",id);
      });    
      $('.AcceptDeleteProduct').click(function(){
         var id = $(this).data("id");
         $.ajax({
            data:{'id':id },
            url: "{{ route('DeleteProduct') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $('#ConfirmDelete').modal('hide');
               table.draw();
            },
         });
      });
   $(".btnCloseModel").click(function() {
      $('#GroupModel').modal('hide');
      $('#ShowCPNModel').modal('hide');
      $('#ConfirmDelete').modal('hide');
   });
});     
</script> 
@endsection