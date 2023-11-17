@extends('Admin.Layout.Home')
@section('link')
<!-- InternalFileupload css-->
<link href="{{ loadA('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">لیست تصاویر وب سایت</h2> 
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>تصاویر وب سایت</li>
         <li class="breadcrumb-item active" aria-current="page">تصاویر</li>
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
                   <label class="main-content-label my-auto">لیست تصاویر</label>
                     <h6 class="mb-0 mr-auto"><a id="createNewAsset" href="javascript:void(0)" class="btn btn-primary float-right dropify-clear"><ion-icon class="m-top" name="add-circle-outline"></ion-icon></a></h6>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-Color">
                        <thead>
                        <tr>
                           <th>شماره</th>
                           <th>جایگاه</th>
                           <th>تصویر</th>
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


<!-- Form Modal errorModel -->
<div class="modal" id="errorModel">
   <div class="modal-dialog wd-xl-400" role="document">
      <div class="modal-content">
       <div class="modal-body pd-20 pd-sm-40">
           <a href="javascript:void(0)" data-bs-dismiss="modal"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
           <br>
           <h5 class="modal-title mb-4 text-center">شما تمامی تصاویر را ایجاد کردید</h5>
           <div class="row">
              <div class="col-6"></div>
              <div class="col-6">
                  <a href="javascript:void(0)"  class="btn ripple btn-primary col-12" data-bs-dismiss="modal">متوجه شدم !</a>
              </div>
           </div>
        </div>
      </div>
   </div>
</div>
<!-- End Form Modal errorModel -->


<!-- Form Modal AssetModel -->
<div class="modal" id="AssetModel">
   <div class="modal-dialog wd-xl-400">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
            <a href="javascript:void(0)" data-bs-dismiss="modal"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 id="title-model" class="modal-title mb-4 text-center">افزودن تصویر</h5>
               <form id="AssetForm" class="forms-sample" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <div id="data-Number" class="col-lg-12 form-group">
                        <label class="form-label">جایگاه تصویر : <span class="tx-danger">*</span></label>
                        <select id="Number" name="Number" class="form-control select2 required">
                           <option selected disabled label="یکی را انتخاب کن"></option>
                           @foreach ($Assets as $Asset)
                           <option value="{{ $Asset->Number }}">{{ $Asset->Name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-12">
                        <div id="img-input" class="form-group">
                           <p class="mg-b-10">تصویر اصلی محصول : </p>
                           <input type="file" name="img" id="img" class="dropify" data-height="200">
                        </div>
                     </div>
                  </div>
                  <div id="id-Color"></div>
                  <button type="submit" id="Savebtn" value="create" class="btn ripple btn-success col-12">ثبت اطلاعات</button>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal AssetModel -->
@endsection
@section('script')
<!-- Internal Fileuploads js-->
<script src="{{ loadA('assets/plugins/fileuploads/js/fileupload.js ') }}"></script>
<script src="{{ loadA('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

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
         ajax: "{{ route('Assets') }}",
         columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex'},
               {data: 'Name', name: 'Name'},
               {data: 'image', name: 'image', orderable: true, searchable: false},
               {data: 'action', name: 'action', orderable: true, searchable: false},
         ]
      });
       $('.table').removeClass('dataTable');

       
       $('#createNewAsset').click(function() {
         $.ajax({
            url: "{{ route('Showimage') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               if(data.Number === false)
               {
                  $('#errorModel').modal('show');
               }else{
                  $('#Number').remove();
                  $('#data-Number').append(data.Number);
                  $('#Savebtn').removeClass('btn-warning');
                  $('#Savebtn').addClass('btn-success');
                  $('#Savebtn').text('ثبت اطلاعات');
                  $('#AssetModel').modal('show');
               }
            },
         });
       });
       $('#AssetForm').on('submit',function(event){
         event.preventDefault();
         $(".loader-div").show();
         $.ajax({
            url: "{{ route('Addimage') }}",
            method:"POST",
            data:new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
               $('#AssetModel').modal('hide');
               $('#Number').remove();
               $('#data-Number').append(data.Number);
               $(".loader-div").hide();
               table.draw();
            },
         })
      }); 
      $('body').on('click', '.editAsset', function () {
            var id = $(this).data("id");
            $.ajax({
               data:{'id':id },
               url: "{{ route('Editimage') }}",
               type: "POST",
               dataType: 'json',
               success: function (data) {
                  $('#Number').remove();
                  $('#data-Number').append(data.Number);
                  $('#Savebtn').addClass('btn-warning');
                  $('#Savebtn').removeClass('btn-success');
                  $('#Savebtn').text('ویرایش اطلاعات');
                  $('#AssetModel').modal('show');
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