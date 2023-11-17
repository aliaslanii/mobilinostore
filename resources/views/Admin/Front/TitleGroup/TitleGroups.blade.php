@extends('Admin.Layout.Home')
@section('Content')
<!-- Page Header -->
 <div class="page-header">
    <div>
       <h2 class="main-content-title tx-24 mg-b-5">لیست تیتر گروه ها</h2>
       <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"></a>دسته بندی محصولات</li>
            <li class="breadcrumb-item active" aria-current="page">تیتر گروه ها</li>
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
                      <h6 class="mb-0 mr-auto"><a id="createNewTitleGroup" href="javascript:void(0)" class="btn btn-primary float-right dropify-clear"><ion-icon class="m-top" name="add-circle-outline"></ion-icon></a></h6>
                   </div>
                   <div class="table-responsive">
                      <table class="table border text-md-nowrap text-nowrap data-table-TitleGroup">
                         <thead>
                         <tr>
                            <th>#</th>
                            <th>تیتر</th>
                            <th>دسته بندی مرتبت</th>
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
<div class="modal" id="TitleGroupModel">
    <div class="modal-dialog wd-xl-400" role="document">
        <div class="modal-content">
            <div class="modal-body pd-20 pd-sm-40">
                <a href="javascript:void(0)" class="btnCloseModel"><ion-icon class="btn-colose-model" name="close-circle-outline"></ion-icon></a>
                <br>
                <h5 id="title-model" class="modal-title mb-4 text-center">ایجاد تیتر گروه ها</h5>
                <form id="TitleGroupForm" class="forms-sample text-right" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <p class="mg-b-10">تیتر</p>
                    <input type="text" class="form-control" id="TitleGroup-title" required name="title" placeholder="تیتر">
                </div>
                <div id="choice-TitleGroup" class="col-sm-12 mg-t-20 mg-sm-t-0 mb-3">
                    <p class="mg-b-10">دسته بندی</p>
                </div>
                <div id="TitleGroup-id"></div>
                <button type="button" id="btnTitleGroup" value="create" class="btn ripple btn-success col-12">ثبت اطلاعات</button>
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
                <h5 class="modal-title mb-4 text-center">از حذف کردن تیترگروه اطمینان دارید ؟</h5>
                <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <a href="javascript:void(0)" type="submit" class="btn ripple btn-primary btnCloseModel">بیخیال !</a>
                    <a href="javascript:void(0)" type="submit" id="AcceptDeleteTitleGroup" class="btn ripple btn-danger me-1">حذف</a>
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
            <h5 class="modal-title mb-4 text-center">قبل از ایجاد گروه باید دسته بندی ایجاد کنید</h5>
            <div class="row">
               <div class="col-6"></div>
               <div class="col-6">
                    <a href="javascript:void(0)" type="submit" class="btn ripple btn-primary col-12 btnCloseModel">متوجه شدم !</a>
               </div>
            </div>
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
            var table = $('.data-table-TitleGroup').DataTable({
                bAutoWidth:false,
                processing: true,
                serverSide: true,
                "language": {
                    "info": "نمایش _START_ تا _END_ از _TOTAL_ نتیجه",
                    "sSearch": "جست و جو : ",
                    "sProcessing": "درحال بارگذاری ...",
                    "sLengthMenu": "نمایش _MENU_ اطلاعات",
                    "sLoadingRecords": "بارگذاری ....",
                    "sInfoFiltered": "(نتیجه جست و جو شما از  _MAX_ اطلاعات)",
                    "sZeroRecords": "هیچ اطلاعاتی برای جست و جو شما پیدا نشد",
                    "sInfoEmpty": "نمایش رکوردها از 0 تا 0 از مجموع 0 رکورد",
                    "oPaginate": {
                        "sFirst": "اولین",
                        "sLast": "آخرین",
                        "sNext": "بعدی",
                        "sPrevious": "قبلی"
                    },
                },
                ajax: "{{ route('TitleGroups') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'title',name: 'title' },
                    { data: 'Categorys',name: 'Categorys'},
                    { data: 'action', name: 'action', orderable: true, searchable: false },
                ]
            });
            $('.table').removeClass('dataTable');

            $('#createNewTitleGroup').click(function() {
                $("#btnTitleGroup").removeClass('btn-warning');
                $("#btnTitleGroup").addClass('btn-success');
                $.ajax({
                    url: "{{ route('TitleGroupCreate') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#TitleGroupCategorys').remove();
                        if(data !== 0){
                            $('#choice-TitleGroup').append(data);
                            $('#TitleGroupForm').trigger("reset");
                            $('#TitleGroupModel').modal('show');
                            $('#btnTitleGroup').val('create');
                            $('#btnTitleGroup').text('ثبت اطلاعات');
                            $('#title-model').text('ایجاد تیتر گروه');
                        } else {
                            $('#errorModel').modal('show');
                        }
                    },
                });
            });
            $('body').on('click', '.editTitleGroup', function() {
                $('#TitleGroupModel').modal('show');
                $(".loader-div").show();
                $('#btnTitleGroup').val('update');
                $('#btnTitleGroup').text('ویرایش اطلاعات');
                $('#title-model').text('ویرایش تیتر گروه');
                $('#TitleGroupCategorys').remove();
                $("#btnTitleGroup").removeClass('btn-success');
                $("#btnTitleGroup").addClass('btn-warning');
               var id = $(this).data("id");
               $.ajax({
                  data: {'id': id },
                  url: "{{ route('EditeTitleGroup') }}",
                  type: "POST",
                  dataType: 'json',
                  success: function(data) {
                    $("#TitleGroup-id").append('<input type="hidden" name="id" value="'+data.Titlegroup.id+'" >');
                    $('#TitleGroup-title').val(data.Titlegroup.title);
                    $('#choice-TitleGroup').append(data.Categorys);
                    $(".loader-div").hide();
                  },
               });
            });

            $('#btnTitleGroup').click(function() {
                var value = $('#btnTitleGroup').val();
                $(".loader-div").show();
                if (value === 'create') {
                    var adress = "{{ route('insertTitleGroup') }}";
                } else {
                    var adress = "{{ route('UpdateTitleGroup') }}";
                }
                $.ajax({
                    data: $('#TitleGroupForm').serialize(),
                    url: adress,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#TitleGroupModel').modal('hide');
                        $('#TitleGroupForm').trigger("reset");
                        $(".loader-div").hide();
                        table.draw();
                    },
                    error: function(data) {
                        $(".loader-div").hide();
                        console.log('Error:', data);
                    }
                });
            });

            $('body').on('click', '.deleteTitleGroup', function() {
                var id = $(this).data("id");
                $('#ConfirmDelete').modal('show');
                $('#AcceptDeleteTitleGroup').attr("data-id", id);
            });
            $('#AcceptDeleteTitleGroup').click(function() {
                var id = $(this).data("id");
                $.ajax({
                    data: {'id': id },
                    url: "{{ route('DeleteTitleGroup') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#ConfirmDelete').modal('hide');
                        table.draw();
                    },
                });
            });
            $(".btnCloseModel").click(function() {
                $('#TitleGroupModel').modal('hide');
                $('#errorModel').modal('hide');
                $('#ConfirmDelete').modal('hide');
            });
        });
    </script>
@endsection