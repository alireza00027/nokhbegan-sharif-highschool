@extends('layouts.app', ['title' => $title])
@section('style')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset("plugins/datatables/dataTables.bootstrap4.css")}}">
    <link rel="stylesheet" href="{{asset('css/admin/users/users.css')}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card card-nokhbegan">
                        <div class="border-bottom-0 mx-4 mt-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <h3 class="card-title">لیست دسترسی ها</h3>
                                <button type="button" class="btn btn-outline-nokhbegan d-flex align-items-center py-1 mr-3" data-toggle="modal" data-target="#newLevel">
                                    <i class="fa fa-plus ml-2"></i>
                                    دسترسی جدید
                                </button>
                            </div>
                            <form action="{{route('admin.level.index')}}">
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input aria-label="" type="text" name="searchRole" class="form-control float-right" placeholder="جستجو">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            @include('layouts.sections.errors')
                            <table id="usersList" class="table table-hover text-center" style="border-spacing: 0; border-collapse: separate;">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>موبایل</th>
                                    <th>نام دسترسی</th>
                                    <th>وظایف</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    @if(count($role->users))
                                        @foreach($role->users as $user)
                                            <tr>
                                                <td>{{$role->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->mobile}}</td>
                                                <td>{{$role->name}}</td>
                                                <td>{{$role->title}}</td>
                                                <td>
                                                    <form action="{{route('admin.level.delete',['user'=>$user->id])}}" method="post">
                                                        {{csrf_field()}}
                                                        {{method_field('delete')}}
                                                        <input id="role_id" name="role_id" hidden value="{{$role->id}}">
                                                        <button type="submit" class="btn bg-transparent p-2">
                                                            <i class="fa fa-trash text-danger fs4"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="newLevel" tabindex="-1" role="dialog" aria-labelledby="newLevel" aria-hidden="true">
        <div class="modal-dialog modal-lg animation" role="document">
            <div class="modal-content">
                <form action="{{route('admin.level.store')}}" method="post" autocomplete="off" class="w-100 needs-validation" novalidate>
                    {{csrf_field()}}
                    <div class="modal-header d-flex flex-row align-items-center justify-content-between">
                        <h5 class="modal-title">افزودن دسترسی جدید</h5>
                    </div>
                    <div class="modal-body">
                        <div class="w-100 d-flex flex-column mt-3 mb-4">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="" class="form-label">
                                        مقام:
                                    </label>
                                    <select class="selectpicker form-control fs-2 " multiple data-live-search="true" id="role_id" name="role_id[]">
                                        <option value="1" >مدیر</option>
                                        <option value="2">معاون</option>
                                        <option value="3">معلم</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="user_id" class="form-label">
                                        مدیر تیم
                                    </label>
                                    <select
                                        class="form-control fs2"
                                        id="user_id"
                                        name="user_id"
                                        required
                                    >
                                        @foreach($teachers as $teacher)
                                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                        @endforeach
                                    </select>
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
    <!-- DataTables -->
    <script src="{{asset("plugins/datatables/jquery.dataTables.js")}}"></script>
    <script src="{{asset("plugins/datatables/dataTables.bootstrap4.js")}}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{asset("plugins/slimScroll/jquery.slimscroll.min.js")}}"></script>
    <!-- FastClick -->
    <script src="{{asset("plugins/fastclick/fastclick.js")}}"></script>
    <!-- page script -->
    {{-- <script>
        $(function () {
            $("#usersList").DataTable({
                "language": {
                    "paginate": {
                        "next": "بعدی",
                        "previous" : "قبلی"
                    }
                },
                "ordering": false,
                "lengthChange": false,
                "info" : false,
                "autoWidth": false,
                "searching": false,
            });
        });
    </script> --}}
@endsection
