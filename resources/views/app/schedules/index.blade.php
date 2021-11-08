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
            <div>
                <div>
                    <div class="card card-nokhbegan card-outline pb-3">
                        <div class="w-100 border-bottom-0 pt-3 pb-2 px-3 d-flex flex-column flex-sm-row align-items-center justify-content-between">
                            <h3 class="card-title">لیست آزمون ها</h3>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 table-responsive">
                            <table id="usersLists" class="table table-hover text-center"
                                   style="border-spacing: 0; border-collapse: separate;">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام دانش آموز</th>
                                    <th>پایه تحصیلی</th>
                                    <th>ماه</th>
                                    <th>شماره هفته</th>
                                    <th>تاریخ</th>
                                    <th>مجموع ساعت درخواست شده</th>
                                    <th>مجموع ساعت پاسخ داده شده</th>
                                    <th>عملیات</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($schedules as $schedule)
                                            <tr >
                                                <td>{{$schedule->id}}</td>
                                                <td>{{$schedule->user->name}}</td>
                                                <td>{{$schedule->user->getGadeText()}}</td>
                                                <td>{{$schedule->month}}</td>
                                                <td>{{$schedule->getNumberWeek()}}</td>
                                                <td>{{$schedule->getTime()}}</td>
                                                <td>{{$schedule->sum_hour_request}}</td>
                                                <td>{{$schedule->sum_hour_answer}}</td>
                                                <td>
                                                    <a href="{{route('schedules.show',['schedule'=>$schedule->id])}}" class="btn btn-sm btn-outline-primary">مشاهده</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="mt-4 mr-2" style="text-align: center">
                                {!! $exams->links() !!}
                            </div> --}}
                        </div>
                    </div>
                    <!-- /. box -->
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