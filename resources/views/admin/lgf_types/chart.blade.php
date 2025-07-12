@extends("admin.home")
@section("main_content")
		<div id="content" class="content">
			<ol class="breadcrumb pull-right">
				<li><a href="#">Home</a></li>
				<li><a href="#">Lgf Types</a></li>
				<li class="active">Chart</li>
			</ol>
			<h1 class="page-header">Lgf Types Chart <small>lgf types chart goes here...</small></h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{!! route('lgftypes.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
                </div>
            </div>
			<div class="row">
			    <div class="col-md-6">
                    <div class="panel panel-inverse" data-sortable-id="chart-js-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Line Chart</h4>
                        </div>
                        <div class="panel-body">
                            <p>
                                A line chart is a way of plotting data points on a line.Often, it is used to show trend data, and the comparison of two data sets.
                            </p>
                            <div>
                                <canvas id="line-chart" data-render="chart-js"></canvas>
                            </div>
                        </div>
                    </div>
		        </div>
		    </div>
		</div>
@endsection