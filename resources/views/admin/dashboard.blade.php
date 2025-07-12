@extends('admin.home')

@section('main_content')
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Dashboard <!-- <small>header small text goes here...</small> --></h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-green">
                    <div class="stats-icon"><i class="fa fa-users"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL CLIENTS</h4>
                        <p>{{ number_format($dashboarddata['clientscount']) }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon"><i class="fa fa-money"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL LGF BALANCE</h4>
                        <p>KSH. {{ number_format($dashboarddata['lgfbalance'], 2) }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-purple">
                    <div class="stats-icon"><i class="fa fa-briefcase"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL LOAN BALANCE</h4>
                        <p>{{ number_format($dashboarddata['totalloanbalance'], 2) }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-md-3 col-sm-6">
                <div class="widget widget-stats bg-red">
                    <div class="stats-icon"><i class="fa fa-clock-o"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL FINE AMOUNT</h4>
                        <p>{{ number_format(0, 2) }}</p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
        </div>
        <!-- end row -->
        <!-- begin row -->
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Top 5 Group Contribution Snapshot</h4>
                    </div>
                    <div class="panel-body">
                        <div id="lgf-bar-chart" class="height-sm"></div>
                    </div>
                </div>
            </div>
            <!-- end col-6 -->
            <!-- begin col-6 -->
            <div class="col-md-6">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Top 5 Loan Products</h4>
                    </div>
                    <div class="panel-body">
                        <div id="pie-chart" class="height-sm"></div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Top 10 Group Loans Snapshot</h4>
                    </div>
                    <div class="panel-body">
                        <div id="fine-bar-chart" class="height-sm"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-inverse" data-sortable-id="index-8">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Todo List</h4>
                    </div>
                    <!-- <div class="panel-body p-0">
               <ul class="todolist">
                <li class="active">
                 <a href="javascript:;" class="todolist-container active" data-click="todolist">
                  <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                  <div class="todolist-title">Donec vehicula pretium nisl, id lacinia nisl tincidunt id.</div>
                 </a>
                </li>
                <li>
                 <a href="javascript:;" class="todolist-container" data-click="todolist">
                  <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                  <div class="todolist-title">Duis a ullamcorper massa.</div>
                 </a>
                </li>
                <li>
                 <a href="javascript:;" class="todolist-container" data-click="todolist">
                  <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                  <div class="todolist-title">Phasellus bibendum, odio nec vestibulum ullamcorper.</div>
                 </a>
                </li>
                <li>
                 <a href="javascript:;" class="todolist-container" data-click="todolist">
                  <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                  <div class="todolist-title">Duis pharetra mi sit amet dictum congue.</div>
                 </a>
                </li>
                <li>
                 <a href="javascript:;" class="todolist-container" data-click="todolist">
                  <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                  <div class="todolist-title">Duis pharetra mi sit amet dictum congue.</div>
                 </a>
                </li>
                <li>
                 <a href="javascript:;" class="todolist-container" data-click="todolist">
                  <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                  <div class="todolist-title">Phasellus bibendum, odio nec vestibulum ullamcorper.</div>
                 </a>
                </li>
                <li>
                 <a href="javascript:;" class="todolist-container active" data-click="todolist">
                  <div class="todolist-input"><i class="fa fa-square-o"></i></div>
                  <div class="todolist-title">Donec vehicula pretium nisl, id lacinia nisl tincidunt id.</div>
                 </a>
                </li>
               </ul>
              </div> -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-inverse" data-sortable-id="index-10">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Calendar</h4>
                    </div>
                    <div class="panel-body">
                        <div id="datepicker-inline" class="datepicker-full-width">
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- end row -->
    </div>
    <!-- end #content -->
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/chart-d3.demo.min.js') }}"></script>
    <script type="text/javascript">
        // ChartNvd3.init();  
        function handleBarChart() {
            "use strict";

            var barChartData = [{
                key: 'Cumulative Return',
                values: [
                    @if (isset($dashboarddata['groupcontribution']))
                        @foreach ($dashboarddata['groupcontribution'] as $groupcontribution)
                            {
                                'label': '{{ $groupcontribution['group'] }}',
                                'value': '{{ $groupcontribution['amount'] }}',
                                'color': '{{ $groupcontribution['color'] }}'
                            },
                        @endforeach
                    @endif
                ]
            }];

            nv.addGraph(function() {
                var barChart = nv.models.discreteBarChart()
                    .x(function(d) {
                        return d.label
                    })
                    .y(function(d) {
                        return d.value
                    })
                    .showValues(true)
                    .duration(250);

                barChart.yAxis.axisLabel("Total Contribution");
                barChart.xAxis.axisLabel('Group');

                d3.select('#lgf-bar-chart').append('svg').datum(barChartData).call(barChart);
                nv.utils.windowResize(barChart.update);

                return barChart;
            });
        }

        function handleFineBarChart() {
            "use strict";

            var barChartData = [{
                key: 'Cumulative Return',
                values: [
                    @if (isset($dashboarddata['grouploans']))
                        @foreach ($dashboarddata['grouploans'] as $grouploan)
                            {
                                'label': '{{ $grouploan['group'] }}',
                                'value': '{{ $grouploan['amount'] }}',
                                'color': '{{ $grouploan['color'] }}'
                            },
                        @endforeach
                    @endif
                ]
            }];

            nv.addGraph(function() {
                var barChart = nv.models.discreteBarChart()
                    .x(function(d) {
                        return d.label
                    })
                    .y(function(d) {
                        return d.value
                    })
                    .showValues(true)
                    .duration(250);

                barChart.yAxis.axisLabel("Total Balance");
                barChart.xAxis.axisLabel('Group');

                d3.select('#fine-bar-chart').append('svg').datum(barChartData).call(barChart);
                nv.utils.windowResize(barChart.update);

                return barChart;
            });
        }

        handleFineBarChart();

        var handlePieChart = function() {
            "use strict";

            var pieChartData = [
                @if (isset($dashboarddata['productloans']))
                    @foreach ($dashboarddata['productloans'] as $productloan)
                        {
                            'label': '{{ $productloan['product'] }}',
                            'value': '{{ $productloan['amount'] }}',
                            'color': '{{ $productloan['color'] }}'
                        },
                    @endforeach
                @endif
            ];

            nv.addGraph(function() {
                var pieChart = nv.models.pieChart()
                    .x(function(d) {
                        return d.label
                    })
                    .y(function(d) {
                        return d.value
                    })
                    .showLabels(true)
                    .labelThreshold(.05);

                d3.select('#pie-chart').append('svg')
                    .datum(pieChartData)
                    .transition().duration(350)
                    .call(pieChart);

                return pieChart;
            });


        };

        handlePieChart();
    </script>
@endsection
