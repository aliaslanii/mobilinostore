@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">لیست کامنت ها</h2> 
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>کامنت محصولات</li>
         <li class="breadcrumb-item active" aria-current="page">کامنت ها</li>
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
                   <label class="main-content-label my-auto">لیست کامنت ها</label>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-Gruop">
                        <thead>
                        <tr>
                           <th>#</th>
                           <th>موضوع نظر</th>
                           <th>کاربر</th>
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

<!-- ShowComment -->
<div class="modal" id="ShowComment">
   <div class="modal-dialog modal-md">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
            <h6 class="modal-title State-title"></h6><a href="javascript:void(0)" data-bs-dismiss="modal"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
         </div>
         <div class="modal-body">
            <div class="row row-sm">
               <div id="data-Comment">
                  
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button class="btn ripple btn-secondary deleteComment" type="button">حذف</button>
            <button class="btn ripple btn-primary AcceptComment" type="button">تائید</button>
         </div>
      </div>
   </div>
</div>
<!--End ShowComment -->



@endsection
@section('script')
<script type="text/javascript">
     $(function() {
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
      var table = $('.data-table-Gruop').DataTable({
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
         ajax: "{{ route('Commnets') }}",
         columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex'},
               {data: 'Subject', name: 'Subject'},
               {data: 'User', name: 'User'},
               {data: 'action', name: 'action', orderable: true, searchable: false},
         ]});
      $('.table').removeClass('dataTable');

      $('body').on('click', '.ShowComment', function() {
         $('#ShowComment').modal('show');
         $(".loader-div").show();
         var id = $(this).data("id");
         $.ajax({
            data: {'id': id },
            url: "{{ route('CommnetsShow') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
               $('.Comment-detal').remove();
               $("#data-Comment").append(data.getComment);
               $(".AcceptComment").attr("data-id",data.id);
               $(".deleteComment").attr("data-id",data.id);
               $(".loader-div").hide();
            },
            
         });
      });
      
      $('body').on('click', '.AcceptComment', function() {
         var id = $(this).data("id");
         $(".loader-div").show();
         $.ajax({
            data:{'id':id },
            url: "{{ route('CommnetAccept') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               table.draw();
               $('#ShowComment').modal('hide');
               $(".loader-div").hide();
            },
            error: function(data){
               alert(data);
            },
         });
      });


      $('body').on('click', '.deleteComment', function() {
         var id = $(this).data("id");
         $(".loader-div").show();
         $.ajax({
            data:{'id':id },
            url: "{{ route('CommnetDelete') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               table.draw();
               $('#ShowComment').modal('hide');
               $(".loader-div").hide();
            },
         });
      });

   $(".btnCloseModel").click(function() {
      $('#ShowComment').modal('hide');
      $('#errorModel').modal('hide');
      $('#ConfirmDelete').modal('hide');
   });
});     
</script> 
@endsection