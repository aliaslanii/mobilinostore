@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">لیست رنگ ها</h2> 
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>رنگ محصولات</li>
         <li class="breadcrumb-item active" aria-current="page">رنگ ها</li>
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
                   <label class="main-content-label my-auto">لیست رنگ ها</label>
                     <h6 class="mb-0 mr-auto"><a id="createNewColor" href="javascript:void(0)" class="btn btn-primary float-right dropify-clear"><ion-icon class="m-top" name="add-circle-outline"></ion-icon></a></h6>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-Color">
                        <thead>
                        <tr>
                           <th>شماره</th>
                           <th>نام رنگ</th>
                           <th>رنگ</th>
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

<!-- Form Modal ColorModel -->
<div class="modal" id="ColorModel">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 id="title-model" class="modal-title mb-4 text-center">ایجاد رنگ</h5>
               <form id="ColorForm" class="forms-sample" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <p class="mg-b-10">نام </p>
                     <input type="text" name="Name" id="Color-Name" class="form-control" required placeholder="نام رنگ">
                  </div>
                  <div class="form-group">
                     <label>رنگ مورد نظر</label>
                     <input required type="color" id="Color-Color" name="Color" class="form-control input-color" >
                  </div>
                  <div id="id-Color"></div>
                  <button type="button" id="btnColor" value="create" class="btn ripple btn-success col-12">ثبت اطلاعات</button>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal ColorModel -->

<!-- Form Modal ConfirmDelete -->
<div class="modal" id="ConfirmDelete">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 class="modal-title mb-4 text-center">از حذف کردن رنگ اطمینان دارید ؟</h5>
               <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                   <a href="javascript:void(0)" type="submit" class="btn ripple btn-primary btnCloseModel">بیخیال !</a>
                   <a href="javascript:void(0)" type="submit" id="AcceptDeleteColor" class="btn ripple btn-danger me-1">حذف</a>
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
    var table = $('.data-table-Color').DataTable({
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
         ajax: "{{ route('Colors') }}",
         columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex'},
               {data: 'Name', name: 'Name'},
               {data: 'Color', name: 'Color', orderable: true, searchable: false},
               {data: 'action', name: 'action', orderable: true, searchable: false},
         ]
       });
       $('.table').removeClass('dataTable');

       $('#createNewColor').click(function () {
          $('#ColorForm').trigger("reset");
          $('#ColorModel').modal('show');
          $('#btnColor').val('create');
          $('#btnColor').text('ثبت اطلاعات');
          $('#title-model').text('ایجاد رنگ');
          $("#btnColor").removeClass('btn-warning');
         $("#btnColor").addClass('btn-success');
       });

       $('body').on('click', '.editColor', function() {
         $('#ColorModel').modal('show');
         $(".loader-div").show();
         $("#btnColor").removeClass('btn-success');
         $("#btnColor").addClass('btn-warning');
         $('#btnColor').val('update');
         $('#btnColor').text('ویرایش اطلاعات');
         $('#title-model').text('ویرایش رنگ');
          var id = $(this).data("id");
          $.ajax({
             data:{'id':id },
             url: "{{ route('EditeColor') }}",
             type: "POST",
             dataType: 'json',
             success: function (data) {
                $('#Color-Name').val(data.Name);
                $('#Color-Color').val(data.Color);
                $('#Color-id').remove();
                $("#id-Color").append('<input id="Color-id" type="hidden" name="id" value="'+data.id+'" >');
                $('#saveColor').attr('hidden','true');
                $('#updateColor').removeAttr('hidden');
                $(".loader-div").hide();
             },
          });
       });

       $('#btnColor').click(function() {
         var value = $('#btnColor').val();
         $(".loader-div").show();
         if(value === 'create'){
            var adress = "{{ route('insertColor') }}";
         }
         else{
            var adress = "{{ route('UpdateColor') }}";
         }
          $.ajax({
          data: $('#ColorForm').serialize(),
          url: adress,
          type: "POST",
          dataType: 'json',
          success: function (data) {
             $('#ColorModel').modal('hide');
             $('#ColorForm').trigger("reset");
             table.draw();
             $(".loader-div").hide();
             },
             error: function (data) {
                console.log('Error:', data);
             }
          });
    });  
    $('body').on('click', '.deletColor', function () {
          var id = $(this).data("id");
          $('#ConfirmDelete').modal('show');
          $('#AcceptDeleteColor').attr("data-id",id);
       });    
       $('#AcceptDeleteColor').click(function(){
          var id = $(this).data("id");
          $.ajax({
             data:{'id':id },
             url: "{{ route('DeleteColor') }}",
             type: "POST",
             dataType: 'json',
             success: function (data) {
                $('#ConfirmDelete').modal('hide');
                table.draw();
             },
          });
       });
       $(".btnCloseModel").click(function(){
         $('#ColorModel').modal('hide');
         $('#ConfirmDelete').modal('hide');
      });
});     
</script> 
@endsection