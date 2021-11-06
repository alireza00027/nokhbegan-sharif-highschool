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
        <div class="row">
            <div class="col-12">
                <div class="card card-nokhbegan">
                    <div class="card-header">
                        <h3 class="card-title">برنامه هفتگی : {{$user->name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    
                        <form action="{{route('admin.schedules.process',['schedule'=>$schedule->id])}}" method="post" class="form-control">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                            <div class="card-body ">
                                @include('layouts.sections.errors')
                                <hr class="w-100 m-0">
                        <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start mx-sm-3 mt-4">

                            <div class="mr-sm-5 mt-4 mt-sm-0">
                                <div class="mt-3 mt-sm-2">
                                    <label for="month" class="width120">ماه: </label>
                                    <span id="month">{{$schedule->month}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="day_of_week" class="width120">هفته: </label>
                                    <span id="day_of_week">{{$schedule->getNumberWeek()}}</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="sum_hour_request" class="width120">مجموع زمان در نظر گرفته شده : </label>
                                    <span id="sum_hour_request" class="text-success">{{$schedule->sum_hour_request}} دقیقه</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="sum_hour_answer" class="width120">مجموع زمان پاسخ داده شده: </label>
                                    <span id="sum_hour_answer" class="text-danger">{{$schedule->sum_hour_answer==null ? 0 : $schedule->sum_hour_answer}} دقیقه</span>
                                </div>
                            </div>
                        </div>
                                <div class="row mt-3">
                                    <div class="card card-nokhbegan">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                            <tr class="bg-info">
                                                                <th>روز ها</th>
                                                                <th>دروس امروز</th>
                                                                <th>دروس فردا</th>
                                                                <th>مرور دروس قبل</th>
                                                                <th>تکالیف</th>
                                                                <th>مجموع ساعت</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($requestScheduleItems as $key =>$value)
                                                                <tr>
                                                                    <th class="text-bold">{{$value->getDayOfWeekText()}}</th>
                                                                    <td>
                                                                        <input name="request_amount_today_lessons_{{$value->day_of_week}}" id="request_amount_today_lessons" class="form-control text-center"value="{{$value->amount_today_lessons}}">
                                                                        <input name="answer_amount_today_lessons_{{$answerScheduleItems[$key]->day_of_week}}" id="answer_amount_today_lessons" class="form-control text-danger text-center bg-secondary" disabled value="{{$answerScheduleItems[$key]->amount_today_lessons}}">
                                                                    </td>
                                                                    <td>
                                                                        <input name="request_amount_tomorow_lessons_{{$value->day_of_week}}" id="request_amount_tomorow_lessons" class="form-control text-center"value="{{$value->amount_tomorow_lessons}}">
                                                                        <input name="answer_amount_tomorow_lessons_{{$answerScheduleItems[$key]->day_of_week}}" id="answer_amount_tomorow_lessons" class="form-control text-danger text-center bg-secondary" disabled value="{{$answerScheduleItems[$key]->amount_tomorow_lessons}}">
                                                                    </td>
                                                                    <td>
                                                                        <input name="request_amount_review_previous_lessons_{{$value->day_of_week}}" id="request_amount_review_previous_lessons" class="form-control text-center"value="{{$value->amount_review_previous_lessons}}">
                                                                        <input name="answer_amount_review_previous_lessons_{{$answerScheduleItems[$key]->day_of_week}}" id="answer_amount_review_previous_lessons" class="form-control text-danger text-center bg-secondary" disabled value="{{$answerScheduleItems[$key]->amount_review_previous_lessons}}">
                                                                    </td>
                                                                    <td>
                                                                        <input name="request_home_work_{{$value->day_of_week}}" id="request_home_work" class="form-control text-center"value="{{$value->home_work}}">
                                                                        <input name="answer_home_work_{{$answerScheduleItems[$key]->day_of_week}}" id="answer_home_work" class="form-control text-danger text-center bg-secondary" disabled value="{{$answerScheduleItems[$key]->home_work}}">
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex flex-column mr-4">
                                                                            <span class="text-success">{{$value->sum_hour == null ? 0 : $value->sum_hour}} دقیقه</span>
                                                                            <span class="text-danger mt-3">{{$answerScheduleItems[$key]->sum_hour == null ? 0 : $answerScheduleItems[$key]->sum_hour}} دقیقه</span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-nokhbegan" type="submit">ویرایش</button>
                            </div>
                        </form>
                    
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