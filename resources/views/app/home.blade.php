@extends('layouts.app', ['title' => $title])
@section('style')
    <!-- Persian Data Picker -->
    <link rel="stylesheet" href="{{asset('css/admin/persian-datepicker.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap4.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/admin/exams/exams.css')}}">

@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="card card-nokhbegan">
                <div class="card-header">
                    <div class="card-title">دبیرستان غیر دولتی نخبگان شریف بهرمان</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('financials.index')}}">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                    <div class="card-title">بخش مالی</div>
                    
                                    <p class="pt-3">مشاهده حساب مالی و بررسی اقساط</p>
                                    </div>
                                    <div class="icon">
                                        <i class="nav-icon fa fa-money"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('exams.index')}}">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                    <div class="card-title">آزمون صبحانه</div>
                    
                                    <p class="pt-3">مشاهده و تحلیل نمرات آزمون های صبحانه</p>
                                    </div>
                                    <div class="icon">
                                        <i class="nav-icon fa fa-list-alt"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('schedules.index')}}">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                    <div class="card-title">برنامه هفتگی</div>
                    
                                    <p class="pt-3">مشاهده برنامه های هفنگی و مدیریت آن</p>
                                    </div>
                                    <div class="icon">
                                        <i class="nav-icon fa fa-list-alt"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('users.profile',['user'=>auth()->user()->id])}}">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                    <div class="card-title">اطلاعات کاربری</div>
                    
                                    <p class="pt-3">مشاهده پروفایل و مدیریت رمز عبور</p>
                                    </div>
                                    <div class="icon">
                                        <i class="nav-icon fa fa-user"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <!-- Persian Data Picker -->
    <script src="{{asset('js/persian-date.min.js')}}"></script>
    <script src="{{asset('js/persian-datepicker.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <!-- Page script -->
    <script src="{{asset('js/admin/exams/exam.js')}}"></script>
@endsection