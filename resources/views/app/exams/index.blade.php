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
                <div class="card card-nokhbegan">
                    <div class="card-header">
                        <i class="fa fa-arrow-left ml-1"></i>
                        <span class="fs4 font-weight-bold">انتخاب جزئیات</span>
                    </div>
                    <form action="{{route('exams.index')}}" class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="course_id">درس <span class="text-danger">*</span></label>
                                <select  id="course_id" name="course_id" class="form-control " style="width: 100%;">
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="fromDate">از تاریخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                    </div>
                                    <input id="fromDate" name="fromDate" value="{{request('fromDate')}}" class="fromDate form-control"/>
                                    <input id="altFromDate" name="fromDateTimestamp" type="hidden">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <label for="toDate">تا تاریخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                  </span>
                                    </div>
                                    <input id="toDate" name="toDate" value="{{request('toDate')}}" class="toDate form-control"/>
                                    <input id="altToDate" name="toDateTimestamp" type="hidden">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="col-12 btn btn-nokhbegan mr-auto ml-2 mt-3 searchBtn">
                            پردازش
                        </button>
                    </form>
                </div>
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
                                    <th>درس</th>
                                    <th>تاریخ</th>
                                    <th>وضعیت</th>
                                    <th>نمره</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                        @foreach($exams as $exam)
                                            <tr >
                                                <td>{{$exam->id}}</td>
                                                <td>{{$exam->user->name}}</td>
                                                <td>{{$exam->user->getGadeText()}}</td>
                                                <td>{{$exam->course->title}}</td>
                                                <td>{{$exam->getTime()}}</td>
                                                @php($status=$exam->getStatus())
                                                <td class="bg-{{$status['bg']}}">{{$status['str']}}</td>
                                                <td class="bg-{{$status['bg']}}">{{$exam->point}}</td>
                                                
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="mt-4 mr-2" style="text-align: center">
                                {!! $exams->links() !!}
                            </div> --}}
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12">
                                    <label for="roundedAvg">میانگین نمرات : </label>
                                    <input 
                                    name="roundedAvg" 
                                    id="roundedAvg" 
                                    class="form-control text-center text-bold 
                                    @if($roundedAvg>=0 and $roundedAvg < 0.5) 
                                    bg-veryBad 
                                    @elseif($roundedAvg >= 0.5 and $roundedAvg < 1.0) 
                                    bg-bad
                                    @elseif($roundedAvg >= 1.0 and $roundedAvg < 1.5) 
                                    bg-middle
                                    @elseif($roundedAvg >= 1.5 and $roundedAvg < 2.0) 
                                    bg-good
                                    @elseif($roundedAvg >= 2.0) 
                                    bg-excellent
                                    @endif
                                    " 
                                    value="{{$roundedAvg}}">
                                </div>
                            </div>
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