@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
<div class="page-header">
   <div>
      <h2 class="main-content-title tx-24 mg-b-5">لیست استان ها</h2> 
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"></a>لیست استان ها</li>
         <li class="breadcrumb-item active" aria-current="page">استان/شهر</li>
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
                     <h6 class="mb-0 mr-auto"><a href="javascript:void(0)" class="btn btn-primary float-right dropify-clear AddState"><ion-icon class="m-top" name="add-circle-outline"></ion-icon></a></h6>
                  </div>
                  <div class="table-responsive">
                     <table class="table border text-md-nowrap text-nowrap data-table-State-City">
                        <thead>
                        <tr>
                           <th>#</th>
                           <th>استان</th>
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

<!-- Form Modal CityModel -->
<div class="modal" id="CityModel">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" data-bs-dismiss="modal"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 id="title-model" class="modal-title mb-4 text-center">ایجاد شهر</h5>
               <form id="CityForm" class="forms-sample text-right" method="POST" enctype="multipart/form-data">
               @csrf
                  <div class="form-group">
                     <p class="mg-b-10 State-title">استان : </p>
                  </div>
                  <div id="choice-Group" class="col-sm-12 mg-t-20 mg-sm-t-0 mb-3">
                     <p class="mg-b-10">نام شهر</p>
                     <input type="text" class="form-control" id="City" required name="City" placeholder="نام شهر را وارد کنید">
                  </div>
                  <div id="Group-id"></div>
                  <input type="hidden" id="State-id" name="State_id">
                  <button type="button" id="btnCity" class="btn ripple btn-success col-12">ثبت اطلاعات</button>
               </form>
           </div>
       </div>
   </div>
</div>
<!-- End Form Modal CityModel -->


<!-- ShowCity -->
<div class="modal" id="ShowCity">
   <div class="modal-dialog modal-sm">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
            <h6 class="modal-title State-title"></h6><a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
         </div>
         <div class="modal-body">
            <div class="row row-sm">
               <div id="data-State-City">
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--End ShowCity -->

 <!-- StateModel -->
 <div class="modal" id="StateModel">
   <div class="modal-dialog wd-xl-400">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 id="title-model" class="modal-title mb-4 text-center">ایجاد استان</h5>
               <form id="StateForm" class="forms-sample text-right" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div id="choice-Group" class="col-sm-12 mg-t-20 mg-sm-t-0 mb-3">
                     <p class="mg-b-10">نام استان</p>
                     <input type="text" class="form-control" id="State" required name="State" placeholder="نام استان را وارد کنید">
                  </div>
                  <div id="Group-id"></div>
                  <button type="button" id="btnState" class="btn ripple btn-success col-12">ثبت اطلاعات</button>
               </form>
           </div>
       </div>
   </div>
</div>
<!--End StateModel -->

 <!-- Form Modal ConfirmDelete -->
<div class="modal" id="ConfirmDelete">
   <div class="modal-dialog wd-xl-400" role="document">
       <div class="modal-content">
           <div class="modal-body pd-20 pd-sm-40">
               <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
               <br>
               <h5 class="modal-title mb-4 text-center">از حذف کردن استان اطمینان دارید ؟</h5>
               <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                   <a href="javascript:void(0)" type="submit" class="btn ripple btn-primary btnCloseModel">بیخیال !</a>
                   <a href="javascript:void(0)" type="submit" id="AcceptDeleteState" class="btn ripple btn-danger me-1">حذف</a>
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
        var table = $('.data-table-State-City').DataTable({
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
            ajax: "{{ route('StateCity') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'State', name: 'State'},
                {data: 'action', name: 'action', orderable: true, searchable: false},
            ]});
      $('.table').removeClass('dataTable');

      $('body').on('click','.ShowCity',function() {
        $(".loader-div").show();
        $('#ShowCity').modal('show');
        var id = $(this).data("id");
        $.ajax({
            data: {'id': id },
            url: "{{ route('ShowCity') }}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
                $('.table-Citys').remove();
                $('#data-State-City').append(data.Citys);
                $('.State-title').text("شهر های : "+data.State);
                $(".loader-div").hide();
            },
         });
      });

    $('#btnCity').click(function() {
      $(".loader-div").show();
        $.ajax({
        data: $('#CityForm').serialize(),
        url: "{{ route('insertCity') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            $('#CityModel').modal('hide'); 
            $(".loader-div").hide();
        },
        });
    }); 

    $('#btnState').click(function() {
      $(".loader-div").show();
        $.ajax({
        data: $('#StateForm').serialize(),
        url: "{{ route('insertState') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            $('#StateModel').modal('hide'); 
            table.draw();
            $(".loader-div").hide();
        },
        });
    }); 
      
   $('body').on('click', '.deletCity', function () {
      $(".loader-div").show();
      var id = $(this).data("id");
      var State = $(this).data("state");
      $.ajax({
            data:{'id':id ,'State':State},
            url: "{{ route('DeleteCity') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $('.table-Citys').remove();
               $('#data-State-City').append(data.Citys);
               $(".loader-div").hide();
            },
      });
   }); 
    
      $('body').on('click', '.deleteState', function () {
         var id = $(this).data("id");
         $('#ConfirmDelete').modal('show');
         $('#AcceptDeleteState').attr("data-id",id);
      });    
      $('#AcceptDeleteState').click(function(){
         $(".loader-div").show();
         var id = $(this).data("id");
         $.ajax({
            data:{'id':id },
            url: "{{ route('DeleteState') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               table.draw();
               $('#ConfirmDelete').modal('hide');
               $(".loader-div").hide();
            },
         });
      });               

      $('body').on('click','.AddCity', function () {
         $(".loader-div").show();
         var id = $(this).data("id");
         $('#CityModel').modal('show');
         $.ajax({
            data:{'id':id},
            url: "{{ route('SelectState') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
               $('.State-title').text('استان : '+data.State);   
               $('#State-id').val(id);
               $('#City').val('');
               $(".loader-div").hide();
            },
        });
      }); 

      $('body').on('click','.AddState', function () {
         $('#State').val('');
         $('#StateModel').modal('show');
      }); 


    $(".btnCloseModel").click(function() {
        $('#ShowCity').modal('hide');
        $('#CityModel').modal('hide');
        $('#ConfirmDelete').modal('hide');
        $('#StateModel').modal('hide');
    });
});     
</script> 
@endsection