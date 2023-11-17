@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">لیست برند ها</h2> 
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>برند محصولات</li>
         <li class="breadcrumb-item active" aria-current="page">برند ها</li>
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
                   <label class="main-content-label my-auto">لیست برند ها</label>
                     <h6 class="mb-0 mr-auto"><a id="createNewBerand" href="javascript:void(0)" class="btn btn-primary float-right dropify-clear"><ion-icon class="m-top" name="add-circle-outline"></ion-icon></a></h6>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-Berand">
                        <thead>
                        <tr>
                           <th>#</th>
                           <th>نام برند</th>
                           <th>تصویر</th>
                           <th>دسته بندی ها</th>
                           <th>توضیحات</th>
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

<!-- Form Modal BerandModel -->
<div class="modal" id="BerandModel">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 id="title-model" class="modal-title mb-4 text-center">ایجاد برند</h5>
               <form id="BerandForm" class="forms-sample" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                   <p class="mg-b-10">نام </p>
                   <input type="text" name="Name" id="Name-Berand" class="form-control" required  placeholder="نام برند">
               </div>
               <div class="form-group">
                  <p class="mg-b-10">توضیحات</p>
                  <input type="text" class="form-control" id="Description-Berand" name="Description" placeholder="توضیحات برند ">
               </div>
               <div class="col-12">
                  <label class="ckbox"><input name="is_show" id="suggested-Berand" value="1" type="checkbox"><span>نمایش در صفحه اصلی</span></label>
               </div>
               <div id="selectedimg" class="mb-3 mt-3"></div>
               <div class="input-group file-browser">
                  <input type="text" class="form-control border-left-0 browse-file" placeholder="انتخاب کنید">
                  <label class="input-group-btn">
                        <span class="btn btn-primary">افزودن عکس<input type="file" id="imginput" name="img" style="display: none;"></span>
                  </label>
               </div>
               <div id="CategoryChek">
                  <p class="mg-b-10">دسته بندی های مورد نظر برای برند را انتخاب کنید</p>
                  
               </div>
               <div id="id-Berand"></div>
               <button type="submit" id="btnBerand" value="create" class="btn ripple btn-success col-12">ثبت اطلاعات</button>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal BerandModel -->

<!-- Form Modal ConfirmDelete -->
<div class="modal" id="ConfirmDelete">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 class="modal-title mb-4 text-center">از حذف کردن برند اطمینان دارید ؟</h5>
               <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                   <a href="javascript:void(0)" type="submit" class="btn ripple btn-primary btnCloseModel">بیخیال !</a>
                   <a href="javascript:void(0)" type="submit" class="btn ripple btn-danger me-1 AcceptDeleteBerand">حذف</a>
               </div>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal ConfirmDelete -->

<!-- Form Modal ShowCategorysModel -->
<div class="modal" id="ShowCategorysModel">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 class="modal-title mb-4 text-center">دسته بندی های مرتبت</h5>
               <div id="data-Categorys-Berand"></div>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal ShowCategorysModel -->
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
         ajax: "{{ route('Berands') }}",
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'Name', name: 'Name'},
            {data: 'img', name: 'img', orderable: true, searchable: false},
            {data: 'Category', name: 'Category', orderable: true, searchable: false},
            {data: 'Description', name: 'Description'},
            {data: 'action', name: 'action', orderable: true, searchable: false},
         ]
      });
      $('.table').removeClass('dataTable');

      $('#createNewBerand').click(function () {
         $.ajax({
             url: "{{ route('getBerandCategorys') }}",
             type: "POST",
             dataType: 'json',
             success: function (data) {
               $('.form-check-berand').remove();
               $('#CategoryChek').append(data);
             },
          });
         $("#btnBerand").removeClass('btn-warning');
         $("#btnBerand").addClass('btn-success');
         $('#BerandForm').trigger("reset");
         $('#BerandModel').modal('show');
         $('#btnBerand').val('create');
         $('#suggested-Berand').removeAttr('checked');
         $('#img-old').remove() 
         $('#imgshow').remove() 
         $('#btnBerand').text('ثبت اطلاعات');
         $('#title-model').text('ایجاد برند');
         $('#img').val('');
      });
         
       $('body').on('click', '.editBerand', function() {
         $(".loader-div").show();
         $('#BerandModel').modal('show');
         $("#btnBerand").removeClass('btn-success');
         $("#btnBerand").addClass('btn-warning');
         $('#BerandForm').trigger("reset");
         $('#img-old').remove() 
         $('#imgshow').remove() 
         $('#imginput').val('');
         $('#title-model').text('ویرایش برند');
         $('#btnBerand').val('update');
         $('#btnBerand').text('ویرایش اطلاعات');
         $('.form-check-berand').remove();
         var id = $(this).data("id");
          $.ajax({
             data:{'id':id },
             url: "{{ route('EditeBerand') }}",
             type: "POST",
             dataType: 'json',
             success: function (data) {
               $('#id-Berand').append('<input type="hidden" name="id" value="'+data.Berand.id+'" >');
               $('#selectedimg').append(data.img) 
               $('#Name-Berand').val(data.Berand.Name);
               $('#Description-Berand').val(data.Berand.Description);
               $('#imginput').val('');
               $('#CategoryChek').append(data.Categorys);
               if(data.Berand.is_show === 1)
               {
                  $('#suggested-Berand').attr('checked','true');
               }else{
                  $('#suggested-Berand').removeAttr('checked');
               }
               $(".loader-div").hide();
             },
          });
       });
         
       $('#BerandForm').on('submit',function(event){
         event.preventDefault();
         $(".loader-div").show();
         var value = $(this).parent().find('#btnBerand').val();
         if(value === 'create'){
            var adress = "{{ route('insertBerand') }}";
         }
         else{
            var adress = "{{ route('UpdateBerand') }}";
         }
         $.ajax({
            url: adress,
            method:"POST",
            data:new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
               $('#BerandModel').modal('hide');
               $('#BerandForm').trigger("reset");
               $('#imgsho').hide();
               $('#imginput').val('');
               $(".loader-div").hide();
               table.draw();
            },
            error: function (data) {
               console.log('Error:', data);
               $(".loader-div").hide();
            }
         })
      });

      $('body').on('click', '.deleteBerand', function () {
          var id = $(this).data("id");
         $('#ConfirmDelete').modal('show');
         $('.AcceptDeleteBerand').attr("data-id",id);
       }); 
       $('body').on('click', '.AcceptDeleteBerand', function () { 
         var id = $(this).data("id");
         $.ajax({
            data:{'id':id },
            url: "{{ route('DeleteBerand') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $('#ConfirmDelete').modal('hide');
               table.draw();
            },
         });
      }); 


      $('body').on('click', '.ShowCategorys', function () {
         $(".loader-div").show();
         var id = $(this).data("id");
         $('#ShowCategorysModel').modal('show');
         $.ajax({
            data:{'id':id },
            url: "{{ route('BerandCategorys') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $('.liCategory').remove();
               $('#data-Categorys-Berand').append(data);
               $(".loader-div").hide();
            },
         })
      });    
      $(".btnCloseModel").click(function() {
         $('#BerandModel').modal('hide');
         $('#ConfirmDelete').modal('hide');
         $('#ShowCategorysModel').modal('hide');
      });
   });     

   var selDiv = "";
   var storedFiles = [];
   $(document).ready(function () {
   $("#imginput").on("change", handleFileSelect);
   selDiv = $("#selectedimg");
   });
   function handleFileSelect(e) {
   var files = e.target.files;
   var filesArr = Array.prototype.slice.call(files);
   filesArr.forEach(function (f) {
      if (!f.type.match("image.*")) {
         return;
      }
      storedFiles.push(f);
      var reader = new FileReader();
      reader.onload = function (e) {
         var html =
         '<img src="' +e.target.result + "\" id='imgshow' class='img-thumbnail'>";
         selDiv.html(html);
      };
      reader.readAsDataURL(f);
   });
   }
</script>
@endsection