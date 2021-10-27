@extends('layouts.app',['title'=>$title])

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap4.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/admin/users/users.css')}}">
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
                            <h3 class="card-title">لیست حساب های مالی</h3>
                        </div>
                        <form action="#">
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input aria-label="" type="text" name="search" class="form-control float-right" placeholder="جستجو">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="usersList" class="table table-hover text-center" style="border-spacing: 0; border-collapse: separate;">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام و نام خانوادگی</th>
                                <th>پایه</th>
                                <th>تعداد اقساط</th>
                                <th>مقدار قابل پرداخت</th>
                                <th>مقدار پرداخت شده</th>
                                <th>وضعیت</th>
                                <th>مشاهده</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($financials as $financial)
                                <tr>
                                    <td>{{$financial->id}}</td>
                                    <td>{{$financial->user->name}}</td>
                                    <td>{{$financial->getGrade()}}</td>
                                    <td>{{$financial->n_items}}</td>
                                    <td>{{$financial->amount}}</td>
                                    <td>{{$financial->paid==null ? 0 : $financial->paid}}</td>
                                    <td>
                                        @if ($financial->status="paying")
                                            <span class="badge badge-warning pt-1 fs1 font-weight-light">{{$financial->getStatusText()}}</span>
                                        @elseif($financial->status="paid")
                                            <span class="badge badge-success pt-1 fs1 font-weight-light">{{$financial->getStatusText()}}</span>  
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.financials.show', ['financial'=>$financial->id]) }}" class="btn btn-outline-primary">مشاهده</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mr-2">
                            {!! $financials->links() !!}
                        </div>
                    </div>
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
    <!-- REQUIRED SCRIPTS -->
    <script src="{{asset('js/auth.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
    <!-- page script -->
    <script src="{{asset('js/admin/users/users.js')}}"></script>

@endsection