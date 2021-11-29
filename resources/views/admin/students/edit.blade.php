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
                        <h3 class="card-title">ویرایش:{{$user->name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        {{-- @include('layouts.section.errors') --}}
                        <hr class="w-100 mb-3">
                        <form action="{{route('admin.students.update',['user'=>$user->id])}}" method="post">
                            {{ csrf_field() }}
                            {{method_field('PATCH')}}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="width120">نام و نام خانوادگی: </label>
                                    <input class="form-control" id="name" name="name" value="{{old('name',$user->name)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="width120">شماره موبایل: </label>
                                    <input class="form-control" id="mobile" name="mobile" value="{{old('mobile',$user->mobile)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="natural_id" class="width120">کد ملی: </label>
                                    <input class="form-control" id="natural_id" name="natural_id" value="{{old('natural_id',$user->natural_id)}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="grade" class="width120">پایه: </label>
                                    <select class="form-control select2" id="grade" name="grade">
                                        <option value="teacher" {{$user->grade=="teacher"?'selected':''}}>معلم</option>
                                        <option value="seventh" {{$user->grade=="seventh"?'selected':''}}>هفتم</option>
                                        <option value="eighth" {{$user->grade=="eighth"?'selected':''}}>هشتم</option>
                                        <option value="ninth" {{$user->grade=="ninth"?'selected':''}}>نهم</option>
                                    </select>
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
