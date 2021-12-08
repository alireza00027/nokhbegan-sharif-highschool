@extends('layouts.app',['title'=>$title])
@section('style')
    <link rel="stylesheet" href="{{'css/dashboard.css'}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="{{route('admin.financials.index')}}" class="text-dark">
                            <div class="info-box bg-secondary">
                                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-money"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">بخش مالی</span>
                                    <span style="font-size: 60%; text-bold">مدیریت حساب مالی و اقساط دانش آموزان</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="{{route('admin.exams.index')}}" class="text-dark">
                            <div class="info-box mb-3 bg-secondary">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-file-code-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"> آزمون صبحانه</span>
                                    <span style="font-size: 60%; text-bold">مشاهده نمرات آزمون صبحانه و تحلیل و بررسی آن</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="{{route('admin.schedules.index')}}" class="text-dark">
                            <div class="info-box mb-3 bg-secondary">
                                <span class="info-box-icon bg-success elevation-1"><i class="nav-icon fa fa-list-alt"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">برنامه هفتگی</span>
                                    <span style="font-size: 60%; text-bold">تعریف برنامه هفتگی برای دانش آموزان و مشاهده و بررسی آن ها</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="{{route('admin.students.seventhList')}}" class="text-dark">
                            <div class="info-box mb-3 bg-secondary">
                                <span class="info-box-icon bg-primary  elevation-1"><i class="nav-icon fa fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">کاربران</span>
                                    <span style="font-size: 60%; text-bold">تعریف و مدیریت دانش آموزان و معلمین</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="{{route('admin.level.index')}}" class="text-dark">
                            <div class="info-box mb-3 bg-secondary">
                                <span class="info-box-icon bg-warning elevation-1"><i class="nav-icon fa fa-key"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">سطح دسترسی</span>
                                    <span style="font-size: 60%; text-bold">تعریف و مدیریت دسترسی برای معلمین</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="{{route('admin.courses.index')}}" class="text-dark">
                            <div class="info-box mb-3 bg-secondary">
                                <span class="info-box-icon bg-dark elevation-1"><i class="nav-icon fa fa-gears"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">دروس</span>
                                    <span style="font-size: 60%; text-bold">تعریف و مدیریت درس ها</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <!-- PAGE PLUGINS -->
    <!-- SparkLine -->
    <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jVectorMap -->
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>

@endsection
