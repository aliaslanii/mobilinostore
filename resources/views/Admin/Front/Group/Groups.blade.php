@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">لیست گروه ها</h2> 
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>دسته بندی محصولات</li>
         <li class="breadcrumb-item active" aria-current="page">گروه ها</li>
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
                   <label class="main-content-label my-auto">لیست تیتر گروه ها</label>
                     <h6 class="mb-0 mr-auto"><a id="createNewGroup" href="javascript:void(0)" class="btn btn-primary float-right dropify-clear"><ion-icon class="m-top" name="add-circle-outline"></ion-icon></a></h6>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-Gruop">
                        <thead>
                        <tr>
                           <th>#</th>
                           <th>تیتر</th>
                           <th>دسته بندی</th>
                           <th>گروه</th>
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

<!-- Form Modal TitleGroupModel -->
<div class="modal" id="GroupModel">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 id="title-model" class="modal-title mb-4 text-center">ایجاد گروه ها</h5>
               <form id="GroupForm" class="forms-sample text-right" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                   <p class="mg-b-10">تیتر</p>
                   <input type="text" class="form-control" id="Group-title" required name="title" placeholder="تیتر">
               </div>
               <div id="choice-Group" class="col-sm-12 mg-t-20 mg-sm-t-0 mb-3">
                   <p class="mg-b-10">تیتر گروه</p>
               </div>
               <div id="Group-id"></div>
               <button type="button" id="btnGroup" value="create" class="btn ripple btn-success col-12">ثبت اطلاعات</button>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal TitleGroupModel -->

<!-- Form Modal ConfirmDelete -->
<div class="modal" id="ConfirmDelete">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 class="modal-title mb-4 text-center">از حذف کردن گروه اطمینان دارید ؟</h5>
               <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                   <a href="javascript:void(0)" type="submit" class="btn ripple btn-primary btnCloseModel">بیخیال !</a>
                   <a href="javascript:void(0)" type="submit" id="AcceptDeleteGroup" class="btn ripple btn-danger me-1">حذف</a>
               </div>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal ConfirmDelete -->

<!-- Form Modal errorModel -->
<div class="modal" id="errorModel">
   <div class="modal-dialog wd-xl-400" role="document">
      <div class="modal-content">
       <div class="modal-body pd-20 pd-sm-40">
            <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
            <br>
            <h5 class="modal-title mb-4 text-center">قبل از ایجاد گروه باید تیتر گروه ایجاد کنید</h5>
            <a href="javascript:void(0)" type="submit" class="btn ripple btn-primary col-12 btnCloseModel">متوجه شدم !</a>
        </div>
      </div>
   </div>
</div>
<!-- End Form Modal errorModel -->

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
         ajax: "{{ route('Groups') }}",
         columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex'},
               {data: 'title', name: 'title'},
               {data: 'titlegroup', name: 'titlegroup'},
               {data: 'Categorys', name: 'Categorys'},
               {data: 'action', name: 'action', orderable: true, searchable: false},
         ]});
      $('.table').removeClass('dataTable');
       $('#createNewGroup').click(function() {
         $("#btnGroup").removeClass('btn-warning');
         $("#btnGroup").addClass('btn-success');
         $.ajax({
            url: "{{ route('CreateGroup') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
               $('#TitleGroupCategorys').remove();
               if(data !== 0){
                  $('#Grouptite').remove();
                  $('#choice-Group').append(data);
                  $('#GroupForm').trigger("reset");
                  $('#GroupModel').modal('show');
                  $('#btnGroup').val('create');
                  $('#btnGroup').text('ثبت اطلاعات');
                  $('#title-model').text('ایجاد  گروه');
               } else {
                  $('#errorModel').modal('show');
               }
            },
         });
      });
      $('body').on('click', '.editGroup', function() {
         $('#GroupModel').modal('show');
         $(".loader-div").show();
         $('#btnGroup').val('update');
         $('#btnGroup').text('ویرایش اطلاعات');
         $('#title-model').text('ویرایش  گروه');
         $('#Grouptite').remove();
         $("#btnGroup").removeClass('btn-success');
         $("#btnGroup").addClass('btn-warning');
         var id = $(this).data("id");
         $.ajax({
            data: {'id': id },
            url: "{{ route('EditeGroup') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
               $('#Group-title').val(data.Group.title);
               $("#Group-id").append('<input type="hidden" name="id" value="'+data.Group.id+'" >');
               $('#choice-Group').append(data.Categorys);
               $(".loader-div").hide();
            },
         });
      });

      $('#btnGroup').click(function() {
         var value = $('#btnGroup').val();
         $(".loader-div").show();
         if(value === 'create'){
            var adress = "{{ route('insertGroup') }}";
         }
         else{
            var adress = "{{ route('UpdateGroup') }}";
         }
         $.ajax({
         data: $('#GroupForm').serialize(),
         url: adress,
         type: "POST",
         dataType: 'json',
         success: function (data) {
            $('#GroupModel').modal('hide');
            $('#GroupForm').trigger("reset");
            table.draw();
            $(".loader-div").hide();
            },
            error: function (data) {
               console.log('Error:', data);
            }
         });
      }); 

      $('body').on('click', '.deletGroup', function () {
         var id = $(this).data("id");
         $('#ConfirmDelete').modal('show');
         $('#AcceptDeleteGroup').attr("data-id",id);
      });    
      $('#AcceptDeleteGroup').click(function(){
         var id = $(this).data("id");
         $(".loader-div").show();
         $.ajax({
            data:{'id':id },
            url: "{{ route('DeleteGroup') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $('#ConfirmDelete').modal('hide');
               table.draw();
               $(".loader-div").hide();
            },
         });
      });
   $(".btnCloseModel").click(function() {
      $('#GroupModel').modal('hide');
      $('#errorModel').modal('hide');
      $('#ConfirmDelete').modal('hide');
   });
});     
</script> 
@endsection