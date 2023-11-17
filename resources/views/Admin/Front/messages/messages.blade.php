@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">پیام کاربران</h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>پیام کاربران</li>
      </ol>
   </div>
</div>
<!-- End Page Header -->
<!-- Row -->
<div class="row row-sm">
   <div class="col-xl-3">
   </div>
   <div class="col-xl-6 col-lg-12 col-md-12">
      <div class="card custom-card">
         <div class="card-body">
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="orders" role="tabpanel">
                  <div class="d-flex mb-4">
                     <label class="main-content-label my-auto">پیام کاربران</label>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-messages">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>نام کاربر</th>
                              <th>شماره تماس کاربر اصلی</th>
                              <th>متن پیام</th>
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
   <div class="col-xl-3">
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
            <h5 class="modal-title mb-4 text-center">از حذف کردن پیام اطمینان دارید ؟</h5>
            <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                  <a href="javascript:void(0)" type="submit" id="CancelDeletemessages" class="btn ripple btn-primary">بیخیال !</a>
                  <a href="javascript:void(0)" type="submit" id="AcceptDeletemessages" class="btn ripple btn-danger me-1">حذف</a>
               </div>
            </div>
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
    
    var table = $('.data-table-messages').DataTable({
       bAutoWidth:false,
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
       ajax: "{{ route('messages') }}",
       columns: [
             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
             {data: 'Name', name: 'Name'},
             {data: 'mobile', name: 'mobile'},
             {data: 'message', name: 'message' , orderable: true, searchable: false},
             {data: 'action', name: 'action', orderable: true, searchable: false},
       ]
    });
    $('.table').removeClass('dataTable');

    $('body').on('click', '.deletemessages', function () {
        var id = $(this).data("id");
       $('#ConfirmDelete').modal('show');
       $('#AcceptDeletemessages').attr("data-id",id);
     });    
     $('#AcceptDeletemessages').click(function(){
        var id = $(this).data("id");
        $(".loader-div").show();
        $.ajax({
           data:{'id':id },
           url: "{{ route('deleteMessages') }}",
           type: "POST",
           dataType: 'json',
           success: function (data) {
              $('#ConfirmDelete').modal('hide');
              table.draw();
              $(".loader-div").hide();
           },
        });
     }); 
    $('#CancelDeletemessages').click(function(e){
       $('#ConfirmDelete').modal('hide');
    });
    $(".btnCloseModel").click(function(){
       $('#CategoryModel').modal('hide');
       $('#ConfirmDelete').modal('hide');
    });
 }); 
</script>
@endsection