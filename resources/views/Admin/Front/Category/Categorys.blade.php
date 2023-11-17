@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">دسته بندی ها</h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>دسته بندی محصولات</li>
         <li class="breadcrumb-item active" aria-current="page">دسته بندی ها</li>
      </ol>
   </div>
</div>
<!-- End Page Header -->
{{-- <a class="btn ripple btn-primary" onclick="showalert('a')" data-bs-target="#modaldemo1" data-bs-toggle="modal" href="#">مشاهده نسخه ی نمایشی</a> --}}
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
                     <label class="main-content-label my-auto">دسته بندی ها</label>
                     <h6 class="mb-0 mr-auto"><a id="createNewCategory" href="javascript:void(0)" class="btn btn-primary float-right dropify-clear"><ion-icon class="m-top" name="add-circle-outline"></ion-icon></a></h6>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-Category">
                        <thead>
                        <tr>
                           <th>#</th>
                           <th>نام دسته بندی</th>
                           <th>عکس</th>
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
            <h5 class="modal-title mb-4 text-center">از حذف کردن دسته بندی اطمینان دارید ؟</h5>
            <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                  <a href="javascript:void(0)" type="submit" class="btn ripple btn-primary btnCloseModel">بیخیال !</a>
                  <a href="javascript:void(0)" type="submit" class="btn ripple btn-danger me-1 AcceptDeleteCategory">حذف</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End Form Modal ConfirmDelete -->
<!-- Form Modal CategoryModel -->
<div class="modal" id="CategoryModel">
   <div class="modal-dialog wd-xl-400" role="document">
      <div class="modal-content">
         <div class="modal-body pd-20 pd-sm-40">
            <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
            <br>
            <h5 id="title-model" class="modal-title mb-4 text-center">ایجاد دسته بندی</h5>
            <form dir="rtl" id="CategoryForm" class="forms-sample text-right" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <p class="mg-b-10">نام</p>
                  <input type="text" class="form-control" id="Name-Category" required name="Name" placeholder="نام دسته بندی">
               </div>
               <div class="form-group">
                  <p class="mg-b-10">توضیحات</p>
                  <input type="text" class="form-control" id="Description-Category" name="Description" placeholder="توضیحات دسته بندی">
               </div>
               <div class="col-12">
                  <label class="ckbox"><input id="suggested-Category" name="showhome" value="1" type="checkbox"><span>نمایش در صفحه اصلی</span></label>
               </div>
               <div id="selectedimg" class="mb-3 mt-3"></div>
               <div class="input-group file-browser">
                  <label class="input-group-btn">
                        <span class="btn btn-primary">افزودن عکس<input type="file" id="imginput" name="img" style="display: none;"></span>
                  </label>
               </div>
               <div id="Category-id"></div>
               <button type="submit" id="btnCategory" value="create" class="btn ripple btn-success col-12">ثبت اطلاعات</button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- End Form Modal CategoryModel -->
</div>

<div class="modal" id="modaldemo1">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button aria-label="بستن" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button> <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-success tx-semibold mg-b-20">تبریک می گویم!</h4>
            <p class="mg-b-20 mg-x-20">بسیاری از معابر متن ساختگی در دسترس است ، اما اکثر آنها دچار تغییر شده اند.</p><button aria-label="بستن" class="btn ripple btn-success pd-x-25" data-bs-dismiss="modal" type="button">ادامه هید</button>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
{{-- <script>
   function showalert(id)
   {
      document.getElementById("loader-div").style.display = "block";
   }
</script> --}}
<script type="text/javascript">
     $(function() {
      $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
      });
      
      var table = $('.data-table-Category').DataTable({
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
         ajax: "{{ route('Categorys') }}",
         columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex'},
               {data: 'Name', name: 'Name'},
               {data: 'img', name: 'img', orderable: true, searchable: false},
               {data: 'action', name: 'action', orderable: true, searchable: false},
         ]
      });
      $('.table').removeClass('dataTable');

      $('#createNewCategory').click(function () {
         $("#btnCategory").removeClass('btn-warning');
         $("#btnCategory").addClass('btn-success');
         $('#CategoryForm').trigger("reset");
         $('#btnCategory').val('create');
         $('#suggested-Category').removeAttr('checked');
         $('#btnCategory').text('ثبت اطلاعات');
         $('#title-model').text('ایجاد دسته بندی');
         $('#CategoryModel').modal('show');
         $('#img').removeAttr('data-default-file');
         $('#img-old').remove() 
         $('#img-show').remove() 
         $('#img').val('');
         $('.dropify-filename-inner').text('');
      });
         
       $('body').on('click', '.editCategory', function() {
         var id = $(this).data("id");
         $(".loader-div").show();
         $("#btnCategory").removeClass('btn-success');
         $("#btnCategory").addClass('btn-warning');
         $('#CategoryForm').trigger("reset");
         $('#title-model').text('ویرایش دسته بندی');
         $('#btnCategory').val('update');
         $('#btnCategory').text('ویرایش اطلاعات');
         $('#img-old').remove() 
         $('#img-show').remove() 
         $('#img').val('');
          $.ajax({
             data:{'id':id },
             url: "{{ route('EditeCategory') }}",
             type: "POST",
             dataType: 'json',
             success: function (data) {
               console.error();
               $('#Category-id').append('<input type="hidden" name="id" value="'+data.Category.id+'" >');
               $('#selectedimg').append(data.img);
               $('#Name-Category').val(data.Category.Name);
               $('#Description-Category').val(data.Category.Description);
               $(".loader-div").hide();
               if(data.Category.showhome == 1)
               {
                  $('#suggested-Category').attr('checked','true');
               }else{
                  $('#suggested-Category').removeAttr('checked');
               }
             },
          });
          $('#CategoryModel').modal('show');
       });
         
       $('#CategoryForm').on('submit',function(event){
         event.preventDefault();
         $(".loader-div").show();
         var value = $(this).parent().find('#btnCategory').val();
         if(value === 'create'){
            var adress = "{{ route('insertCategory') }}";
         }
         else{
            var adress = "{{ route('UpdateCategory') }}";
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
               $('#CategoryModel').modal('hide');
               $('#CategoryForm').trigger("reset");
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

      $('body').on('click', '.deleteCategory', function () {
          var id = $(this).data("id");
         $('#ConfirmDelete').modal('show');
         $('.AcceptDeleteCategory').attr("data-id",id);
       });
       $('body').on('click', '.AcceptDeleteCategory', function () {    
          var id = $(this).data("id");
          $.ajax({
             data:{'id':id },
             url: "{{ route('DeleteCategory') }}",
             type: "POST",
             dataType: 'json',
             success: function (data) {
                $('#ConfirmDelete').modal('hide');
                table.draw();
             },
          });
       }); 
      $(".btnCloseModel").click(function(){
         $('#CategoryModel').modal('hide');
         $('#ConfirmDelete').modal('hide');
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
            '<img src="' +e.target.result + "\" id='img-show' class='img-thumbnail img-category' width='200px'>";
            selDiv.html(html);
         };
         reader.readAsDataURL(f);
      });
   }
</script>
@endsection