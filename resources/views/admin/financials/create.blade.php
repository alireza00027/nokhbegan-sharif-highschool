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
                    <div class="border-bottom-0 mx-4 mt-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title">ثبت حساب مالی</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    
                        <form action="{{route('admin.financials.store')}}" method="post" class="form-control">
                            @csrf
                            <div class="card-body ">
                                @include('layouts.sections.errors')
                                <livewire:users.select-students/>
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-4">
                                        <label for="n_items" class="form-label fs2">
                                            تعداد اقساط <span class="text-danger">*</span>
                                        </label>
                                        <select id="n_items" name="n_items" class="form-control " style="width: 100%;">
                                            <option value="1" >تک قسط</option>
                                            <option value="2" >دو قسط</option>
                                            <option value="3" >سه قسط</option>
                                            <option value="6" >شش قسط</option>
                                            <option value="9" >نه قسط</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-4">
                                        <label for="createdAt"> تاریخ</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                          </span>
                                            </div>
                                            <input id="createdAt" name="createdAt"  class="createdAt form-control"/>
                                            <input id="altCreatedAt" name="createdAtTimestamp" type="hidden">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label for="amount" class="form-label fs-2">
                                            کل مبلغ پرداختی <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" id="amount" name="amount" style="width: 100%;" placeholder="کل مبلغ پرداختی">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-nokhbegan" type="submit">ثبت</button>
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