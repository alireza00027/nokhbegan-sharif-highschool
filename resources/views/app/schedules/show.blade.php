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
                        <h3 class="card-title">برنامه هفتگی هفته {{$schedule->getNumberWeek()}} ماه {{$schedule->month}}</h3>
                    </div>
                    <!-- /.card-header -->
                    
                        <form action="{{route('schedules.process',['schedule'=>$schedule->id])}}" method="post" class="form-control">
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
                                    <span id="sum_hour_request" class="text-danger">{{$schedule->sum_hour_request}} دقیقه</span>
                                </div>
                                <div class="mt-3 mt-sm-2">
                                    <label for="sum_hour_answer" class="width120">مجموع زمان پاسخ داده شده: </label>
                                    <span id="sum_hour_answer" class="text-success">{{$schedule->sum_hour_answer==null ? 0 : $schedule->sum_hour_answer}} دقیقه</span>
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
                                                                <th>توضیحات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($answerScheduleItems as $key =>$value)
                                                                <tr>
                                                                    <th class="text-bold">{{$value->getDayOfWeekText()}}</th>
                                                                    <td>
                                                                        <input name="request_amount_today_lessons_{{$requestScheduleItems[$key]->day_of_week}}" id="request_amount_today_lessons" class="form-control text-center text-danger bg-secondary" disabled value="{{$requestScheduleItems[$key]->amount_today_lessons}}">
                                                                        <input name="answer_amount_today_lessons_{{$value->day_of_week}}" id="answer_amount_today_lessons" class="form-control  text-center " @if ($value->day_of_week != $todayName and $value->created_at != $today) disabled @endif  value="{{$value->amount_today_lessons}}">
                                                                    </td>
                                                                    <td>
                                                                        <input name="request_amount_tomorow_lessons_{{$requestScheduleItems[$key]->day_of_week}}" id="request_amount_tomorow_lessons" class="form-control text-danger text-center bg-secondary" disabled value="{{$requestScheduleItems[$key]->amount_tomorow_lessons}}">
                                                                        <input name="answer_amount_tomorow_lessons_{{$value->day_of_week}}" id="answer_amount_tomorow_lessons" class="form-control  text-center " @if ($value->day_of_week != $todayName and $value->created_at != $today) disabled @endif   value="{{$value->amount_tomorow_lessons}}">
                                                                    </td>
                                                                    <td>
                                                                        <input name="request_amount_review_previous_lessons_{{$requestScheduleItems[$key]->day_of_week}}" id="request_amount_review_previous_lessons" class="form-control text-center text-danger bg-secondary" disabled value="{{$requestScheduleItems[$key]->amount_review_previous_lessons}}">
                                                                        <input name="answer_amount_review_previous_lessons_{{$value->day_of_week}}" id="answer_amount_review_previous_lessons" class="form-control  text-center " @if ($value->day_of_week != $todayName and $value->created_at != $today) disabled @endif   value="{{$value->amount_review_previous_lessons}}">
                                                                    </td>
                                                                    <td>
                                                                        <input name="request_home_work_{{$requestScheduleItems[$key]->day_of_week}}" id="request_home_work" class="form-control text-center bg-secondary text-danger" disabled value="{{$requestScheduleItems[$key]->home_work}}">
                                                                        <input name="answer_home_work_{{$value->day_of_week}}" id="answer_home_work" class="form-control  text-center " @if ($value->day_of_week != $todayName and $value->created_at != $today) disabled @endif  value="{{ $value->home_work}}">
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <div class="d-flex flex-column mr-4">
                                                                            <span class="text-danger">{{$requestScheduleItems[$key]->sum_hour == null ? 0 : $requestScheduleItems[$key]->sum_hour}} دقیقه</span>
                                                                            <span class="text-success mt-3">{{$value->sum_hour == null ? 0 : $value->sum_hour}} دقیقه</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" data-modaldata="{{json_encode($requestScheduleItems[$key])}}"class="btn btn-sm btn-outline-nokhbegan btn-open-description-modal mr-2" data-toggle="modal" data-target="#descriptionScheduleItem">
                                                                            توضیحات</i>
                                                                        </button>
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
<div class="modal fade" id="descriptionScheduleItem" tabindex="-1" role="dialog" aria-labelledby="descriptionScheduleItem" aria-hidden="true">
    <div class="modal-dialog modal-lg animation" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex flex-row align-items-center justify-content-between">
                <h5 class="modal-title">جزئیات</h5>
            </div>
            <div class="modal-body d-flex flex-column centered">
                <div class="w-100 d-flex flex-wrap mt-3 mb-4">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-12">
                                <textarea name="modal-description" id="modal-description" cols="30" rows="10" class="form-control" disabled></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
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

    <script>
        $('.btn-open-description-modal').click(function () {
            let formData = $(this).data('modaldata');
            $('#modal-description').val(formData.description);
        });
    </script>
@endsection