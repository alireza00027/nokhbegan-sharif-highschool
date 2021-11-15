@extends('layouts.app',['title'=>$title])
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/users/users.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="card card-nokhbegan card-outline pb-3">
                <div class="border-bottom-0 mx-4 mt-3 d-flex flex-column flex-sm-row align-items-center justify-content-between">
                    <div class="w-100 d-flex align-items-center justify-content-between justify-content-sm-start">
                        <h3 class="card-title">لیست دروس</h3>
                        <div class="d-none d-sm-flex align-items-center justify-content-end">
                            <button type="button" class="btn btn-outline-nokhbegan d-flex align-items-center py-1 mr-3" data-toggle="modal" data-target="#addCourse">
                                <i class="fa fa-plus ml-2"></i>
                                ثبت درس جدید
                            </button>
                        </div>
                        <div class="d-flex d-sm-none btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-v fs4"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-left" role="menu">
                                <button type="button" class="dropdown-item py-2" data-toggle="modal" data-target="#addCourse">
                                    درس جدید
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mt-sm-0">
                        <form action="#">
                            <div class="input-group input-group-sm">
                                <input aria-label="" name="searchUser" type="text" class="form-control" placeholder="جستجوی درس">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-nokhbegan">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0 table-responsive mt-3">
                    @include('layouts.sectionS.errors')
                    <table id="coursesList" class="table table-hover text-center" style="border-spacing: 0; border-collapse: separate;">
                        <thead>
                        <tr>
                            <th style="min-width: 60px">ردیف</th>
                            <th style="min-width: 120px">عنوان درس</th>
                            <th style="min-width: 120px">تعداد واحد</th>
                            <th style="min-width: 120px">تاریخ ثبت</th>
                            <th style="min-width: 120px">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{$course->id}}</td>
                                    <td>{{$course->title}}</td>
                                    <td>{{$course->unit}}</td>
                                    <td>{{$course->getDate()}}</td>
                                    <td>
                                        <button type="button" data-modaldata="{{json_encode($course)}}" data-modalaction="{{route('admin.courses.update',['course'=>$course->id])}}" class="btn bg-transparent p-2 btn-open-edit-modal" data-toggle="modal" data-target="#editCourse">
                                            <i class="fa fa-edit text-dark fs4"></i>
                                        </button>
                                        <button type="button" data-modalaction="{{ route('admin.courses.delete', ['course'=>$course->id]) }}" class="btn bg-transparent p-2 btn-open-delete-modal" data-toggle="modal" data-target="#deleteCourse">
                                            <i class="fa fa-trash text-danger fs4"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 mr-2" style="text-align: center">
                        {!! $courses->links() !!}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="addCourse" tabindex="-1" role="dialog" aria-labelledby="addCourse" aria-hidden="true">
        <div class="modal-dialog modal-lg animation" role="document">
            <div class="modal-content">
                <form id="modal-add-course" action="{{route('admin.courses.store')}}" method="post" autocomplete="off" class="w-100 needs-validation" novalidate>
                    {{csrf_field()}}
                    <div class="modal-header d-flex flex-row align-items-center justify-content-between">
                        <h5 class="modal-title">افزودن درس</h5>
                    </div>
                    <div class="modal-body d-flex flex-column centered">
                        <div class="w-100 d-flex flex-wrap mt-3 mb-4">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-md-4">
                                        <label for="title" class="form-label fs2">
                                            عنوان درس <span class="text-danger">*</span>
                                        </label>
                                        <input id="title" name="title" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6 form-group mb-md-4">
                                        <label for="unit" class="form-label fs2">
                                            تعداد واحد <span class="text-danger">*</span>
                                        </label>
                                        <input id="unit" name="unit" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-nokhbegan">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <div class="modal fade" id="deleteCourse" tabindex="-1" role="dialog" aria-labelledby="deleteCourse" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fa fa-exclamation-triangle text-danger fs10"></i>
                    <p class="mt-4 ">آیا از حذف این درس اطمینان دارید؟</p>
                </div>
                <div class="modal-footer d-flex align-items-center justify-content-between">
                    <form id="modal-delete-course" action="" method="post">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editCourse" tabindex="-1" role="dialog" aria-labelledby="editCourse" aria-hidden="true">
        <div class="modal-dialog modal-lg animation" role="document">
            <div class="modal-content">
                <form id="modal-edit-course" method="post" autocomplete="off" class="w-100 needs-validation" novalidate>
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="modal-header d-flex flex-row align-items-center justify-content-between">
                        <h5 class="modal-title">ویرایش درس</h5>
                    </div>
                    <div class="modal-body d-flex flex-column centered">
                        <div class="w-100 d-flex flex-wrap mt-3 mb-4">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-md-4">
                                        <label for="modal-title" class="form-label fs2">
                                            عنوان درس <span class="text-danger">*</span>
                                        </label>
                                        <input id="modal-title" name="title" class="form-control" value="">
                                    </div>
                                    <div class="col-md-6 form-group mb-md-4">
                                        <label for="modal-unit" class="form-label fs2">
                                            تعداد واحد <span class="text-danger">*</span>
                                        </label>
                                        <input id="modal-unit" name="unit" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-nokhbegan">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- page script -->
    <script>
        $('.btn-open-delete-modal').click(function () {
            let formAction = $(this).data('modalaction');
            $('#modal-delete-course').attr('action', formAction);
        });
    </script>
    <script>
        $('.btn-open-edit-modal').click(function () {
            let formAction = $(this).data('modalaction');
            let formData = $(this).data('modaldata');
            $('#modal-edit-course').attr('action', formAction);
            $('#modal-title').val(formData.title);
            $('#modal-unit').val(formData.unit);
        });
    </script>
@endsection
