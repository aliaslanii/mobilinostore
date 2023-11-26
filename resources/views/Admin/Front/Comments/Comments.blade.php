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
<div class="container">
   <div class="row">
      @if(Session::get('success'))
      <div class="col-md-5 col-sm-8 mt-2" id="successAlert">
         <div class="alert alert-success" role="alert">
            <strong>موفق : </strong>{{ Session::get('success') }}
         </div>
      </div>
      @endif
      @if(Session::get('error'))
      <div class="col-md-5 col-sm-8 mt-2" id="errorAlert">
         <div class="alert alert-danger" role="alert">
            <strong>خطا : </strong>{{ Session::get('error') }}
         </div>
      </div>
      @endif
   </div>
</div>

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
            <form action="{{ route('CommnetDelete') }}" method="POST">
               @csrf
               <input type="hidden" name="id" class="deleteComment-input">
               <button class="btn ripple btn-secondary deleteComment" type="submit">حذف</button>
            </form>
            <form action="{{ route('CommnetAccept') }}" method="POST">
               @csrf
               <input type="hidden" name="id" class="AcceptComment-input">
               <button class="btn ripple btn-primary AcceptComment" type="submit">تائید</button>
            </form>
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
               $(".AcceptComment-input").val(data.id);
               $(".deleteComment-input").val(data.id);
               $(".loader-div").hide();
            },
         });
      });
      $('body').on('click', '.AcceptComment', function() {
         $(".loader-div").show();
      });
      $('body').on('click', '.deleteComment', function() {
         $(".loader-div").show();
      });
      $(".btnCloseModel").click(function() {
         $('#ShowComment').modal('hide');
         $('#errorModel').modal('hide');
         $('#ConfirmDelete').modal('hide');
      });
});     
</script> 
@endsection