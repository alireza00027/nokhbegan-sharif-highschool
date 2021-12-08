@extends('layouts.app',['title'=>$title])
@section('style')
    <link rel="stylesheet" href="{{asset('css/user/profile/profile.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="row d-flex flex-row flex-wrap px-3">
                <div class="card card-primary card-outline col-12">
                    <div class="card-header border-0 d-flex align-items-center justify-content-between">
                        <h3 class="card-title">اطلاعات کاربری</h3>
                        <div class="d-none d-sm-flex align-items-center justify-content-end">
                            <a href="{{route('users.changePassword',['user'=>$user->id])}}" class="btn btn-outline-secondary btn-change-password">
                                ویرایش کلمه عبور
                            </a>
                        </div>
                        <div class="d-flex d-sm-none btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-v fs4"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-left" role="menu">
                                <a href="{{route('users.changePassword',['user'=>$user->id])}}" class="dropdown-item py-2" >
                                    ویرایش کلمه عبور
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        @include('layouts.sections.errors')
                        <hr class="w-100 m-0">
                        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start mx-sm-3 mt-4">
                            <div class="mr-sm-5 mt-4 mt-sm-0">
                                <div class="mt-3 mt-sm-2">
                                    <label for="name" class="width120">نام و نام خانوادگی: </label>
                                    <span id="name">{{$user->name}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="mobile" class="width120">شماره موبایل: </label>
                                    <span id="mobile">{{$user->mobile}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="natural_id" class="width120">کد ملی: </label>
                                    <span id="natural_id">{{$user->natural_id}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="post" class="width120">پایه تحصیلی: </label>
                                    <span id="post">{{$user->getGadeText()}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body-1 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.row -->
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
    <!-- ChartJS 1.0.2 -->
    <script src="{{asset('plugins/chartjs-old/Chart.min.js')}}"></script>
    <script src="{{asset('js/user/profile/profile.js')}}"></script>
@endsection
