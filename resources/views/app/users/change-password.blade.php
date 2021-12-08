@extends('layouts.app',['title'=>$title])
@section('style')
    <link rel="stylesheet" href="{{asset('css/admin/users/users.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content pt-3">
            <div class="row d-flex flex-row flex-wrap px-3">
                <div class="card card-nokhbegan card-outline col-12">
                    <div class="card-header border-0 d-flex align-items-center justify-content-between">
                        <h3 class="card-title">ویرایش کلمه عبور</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        {{-- @include('layouts.section.errors') --}}
                        @include('layouts.sections.errors')
                        <hr class="w-100 mb-3">
                        <form action="{{route('users.changePasswordProcess',['user'=>$user->id])}}" method="post">
                            {{ csrf_field() }}
                            {{method_field('PATCH')}}
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <label for="prevPassword" class="form-label fs2">
                                        کلمه عبور قبلی <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="prevPassword"
                                           class="form-control fs1"
                                           id="prevPassword"
                                           placeholder="کلمه عبور قبلی"
                                           required />
                                </div>
                                <div class="col-md-8 form-group mt-2">
                                    <label for="newPassword" class="form-label fs2">
                                        کلمه عبور جدید<span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="newPassword"
                                           class="form-control fs1"
                                           id="newPassword"
                                           placeholder="کلمه عبور جدید"
                                           required />
                                </div>
                                <div class="col-md-8 form-group mt-2">
                                    <label for="reNewPassword" class="form-label fs2">
                                        تکرار کلمه عبور جدید <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="reNewPassword"
                                           class="form-control fs1"
                                           id="reNewPassword"
                                           placeholder="تکرار کلمه عبور جدید"
                                           required />
                                </div>
                            </div>
                            <button class="btn btn-outline-nokhbegan mt-4" type="submit">ویرایش</button>
                        </form>
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
@endsection
