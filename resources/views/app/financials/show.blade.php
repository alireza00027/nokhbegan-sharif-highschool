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
                        <span class="fs4 font-weight-bold">حساب مالی {{$financial->user->name}}</span>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="card card-nokhbegan card-outline pb-3">
                                <div class="w-100 border-bottom-0 pt-3 pb-2 px-3 d-flex flex-column flex-sm-row align-items-center justify-content-between">
                                    <h3 class="card-title">لیست اقساط</h3>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($financialItems as $item)
                                            <div class="col-sm-4 col-md-4 form-group ">
                                                @if ($item->status=="paying")
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                        <div class="card-title">{{$item->getStatus()}}</div>
                                        
                                                        <p class="pt-3">مبلغ قسط:{{$item->amount}}</p>
                                                        <p>مهلت پرداخت:{{$item->getPayDate()}}</p>
                                                        <p>تاریخ پرداخت:{{$item->getPaidDate()}}</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="ion ion-bag"></i>
                                                        </div>
                                                        <a href="{{route('financialItems.payment',['financialItem'=>$item->id])}}" class="btn btn-sm btn-danger">پرداخت</a>
                                                    </div>
                                                @else
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                        <div class="card-title">{{$item->getStatus()}}</div>
                                        
                                                        <p class="pt-3">مبلغ قسط:{{$item->amount}}</p>
                                                        <p>مهلت پرداخت:{{$item->getPayDate()}}</p>
                                                        <p>تاریخ پرداخت:{{$item->getPaidDate()}}</p>
                                                        </div>
                                                        <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="card-footer p-0">
                                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start mx-sm-3 mt-4">

                                        <div class="mr-sm-5 mt-4 mt-sm-0">
                                            <div class="mt-3 mt-sm-2">
                                                <label for="name" class="width120">پایه: </label>
                                                <span id="name">{{$financial->getGrade()}}</span>
                                            </div>
                                            <div class="mt-3 mt-sm-2">
                                                <label for="mobile" class="width120">مقدار قابل پرداخت: </label>
                                                <span id="mobile">{{$financial->amount}}</span>
                                            </div>
                                            <div class="mt-3 mt-sm-2">
                                                <label for="email" class="width120">مقدار تا کنون پرداخت شده: </label>
                                                <span id="email">{{$financial->paid==null ? 0 : $financial->paid}}</span>
                                            </div>
                                            <div class="mt-3 mt-sm-2">
                                                <label for="post" class="width120">تعداد اقساط: </label>
                                                <span id="post">{{$financial->n_items}}</span>
                                            </div>
                                            <div class="mt-3 mt-sm-2">
                                                <label for="post" class="width120">تعداد اقساط پرداخت شده: </label>
                                                <span id="post">{{$financial->n_paid_items==null ? 0 : $financial->n_paid_items}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /. box -->
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
@endsection