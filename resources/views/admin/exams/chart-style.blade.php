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
                    <form action="{{route('admin.exams.chartStyle')}}" class="card-body">
                        <livewire:exams.filter-exams/>
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-6">
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
                            <div class="form-group col-sm-6 col-md-6">
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
                            <h3 class="card-title">تحلیل نمرات</h3>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>وضعیت نمرات</strong>
                                    </p>

                                    <div class="chart">
                                        <!-- Sales Chart Canvas -->
                                        <canvas id="performance" height="180" style="height: 180px;"></canvas>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                            </div>
                            <!-- /.row -->
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
    <!-- ChartJS 1.0.2 -->
    <script src="{{asset('plugins/chartjs-old/Chart.min.js')}}"></script>

    <!-- Page script -->
    <script src="{{asset('js/admin/exams/exam.js')}}"></script>
    <script>
        $(function () {
            'use strict';
            // Get context with jQuery - using jQuery's .get() method.
            let performanceCanvas = $('#performance').get(0).getContext('2d');
            // This will get the first returned node in the jQuery collection.
            let performance = new Chart(performanceCanvas);

            let performanceData = {
                
                labels  : [@foreach($exams as $data) '{{$data->userName}}', @endforeach],
                datasets: [
                    {
                        label               : 'Digital Goods',
                        fillColor           : 'rgba(0, 123, 255, 0.9)',
                        strokeColor         : 'rgba(0, 123, 255, 1)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(0, 123, 255, 1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(0, 123, 255, 1)',
                        data                : [@foreach($exams as $data) '{{$data->point}}', @endforeach]
                    }
                ]
            };

            let performanceOptions = {
                //Boolean - If we should show the scale at all
                showScale               : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                //Boolean - Whether the line is curved between points
                bezierCurve             : true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot                : false,
                //Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                //String - A legend template
                legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%=datasets[i].label%></li><%}%></ul>',
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            };

            //Create the line chart
            performance.Line(performanceData, performanceOptions)
        });

    </script>
@endsection