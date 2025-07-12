@extends("admin.home")
@section("main_content")
<style type="text/css">
	td div img{
		max-width: 64px;
	}
</style>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">General Reports</a></li>
        <li><a href="#">Periodic Transaction Report</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Periodic Transaction Report <small>groups details goes here...</small></h1>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Group Details</h4>
                </div>
                <div class="panel-body">
                    <label for="Group Number" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Group Number : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $ptr->group_number !!}
                    </label>
                    <label for="Group Name" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Group Name : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $ptr->group_name !!}
                    </label>
                    <label for="Meeting Day" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Meeting Day : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {{ \App\Days::where(['number' => $ptr->meeting_day])->first()->name }}
                    </label>
                    <label for="Meeting Time" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Meeting Time : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $ptr->meeting_time !!}
                    </label>
                    <label for="Meeting Frequency" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Meeting Frequency : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {{ \App\MeetingFrequencies::find($ptr->meeting_frequency)->name }}
                    </label>
                    <label for="Preferred Mode Of Banking" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right" >Preferred Mode Of Banking : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {{ \App\PaymentModes::find($ptr->preferred_mode_of_banking)->name }}
                    </label>
                    <label for="Registration Date" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Registration Date : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $ptr->registration_date !!}
                    </label>
                    <label for="Group Formation Date" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Group Formation Date : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $ptr->group_formation_date !!}
                    </label>
                    <label for="Officer" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Officer : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! \App\Employees::find($ptr->officer)->first_name !!}
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">DataTable - Display</h4>
                </div>

<div class="panel-body">
    <table id="data-table" class="table table-striped table-bordered">
        <thead>
        	<tr>
                <th>CID</th>
                <th>Name</th>
                <th>Loan Number</th>
                <th>Amount</th>
                <th>Expected Pay</th>
                <th>Last Paid</th>
                <th>Arrears / Period</th>
                <th>Next Pay Date</th>
                <th>OLB</th>
                <th>Last LGF</th>
                <th>Total LGF</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($ptr->clients as $client)
            @foreach ($client->loans as $key => $loan)
                <tr>
                    <td class='table-text'>{{ $client->bio->client_number }}</td>
                    <td class='table-text'>{{ $client->bio->first_name }}</td>
                    <td class='table-text'>{{ $loan->loan_number }}<hr>{{ \Carbon\Carbon::parse($loan->date)->format('Y-m-d') }}</td>
	                <td class='table-text'>{{ number_format($loan->amount, 2) }}</td>
	                <td class='table-text'>{{ number_format($loan->view->Expected_Pay[0], 2) }} - W {{ $loan->view->Expected_Pay[1] }}</td>
	                <td class='table-text'>{{ number_format($loan->view->Last_Paid[0], 2) }}<hr>{{ $loan->view->Last_Paid[1] }}</td>
	                <td class='table-text'>{{ $loan->view->Arrears_Period }}</td>
	                <td class='table-text'>{{ $loan->view->Next_Pay_Date }}</td>
	                <td class='table-text'>{{ number_format($loan->view->OLB, 2) }}</td>
                    <td class='table-text'>{{ $client->last_lgf ? number_format($client->last_lgf->amount, 2) : NULL }}</td>
                    <td class='table-text'>{{ $client->lgf_balance ? number_format($client->lgf_balance->balance, 2) : NULL }}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>

</div>
</div>
</div>
</div>
@endsection
@section('script')
@endsection