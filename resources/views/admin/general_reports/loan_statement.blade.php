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
        <li><a href="#">Loan Statement Report</a></li>
        <li class="active">Table</li>
    </ol>
    <h1 class="page-header">Loan Statement Report <small>loan statement details goes here...</small></h1>

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
                    <h4 class="panel-title">Loan Details</h4>
                </div>
                <div class="panel-body">
                    <label for="Loan Number" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Loan Number : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $loan->loan_number !!}
                    </label>
                    <label for="Client" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Client : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! $loan->client->first_name . ' ' . $loan->client->last_name !!}
                    </label>
                    <label for="Disbursment Date" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Disbursment Date : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {{ \Carbon\Carbon::parse($loan->disbursement->date)->format('Y-m-d') }}
                    </label>
                    <label for="Loan Amount" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Loan Amount : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! number_format($loan->total_loan_amount, 2) !!}
                    </label>
                    <label for="Loan Duration" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Loan Duration : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {{ $loan->duration->name }}
                    </label>
                    <label for="Payment Frequency" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10 text-right">Payment Frequency : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {{ $loan->frequency->name }}
                    </label>
                    <label for="Installment Amount" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Installment Amount : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {{ number_format($loan->installment, 2) }}
                    </label>
                    <label for="Current Balance" class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10  text-right">Current Balance : </label>
                    <label class="col-md-3 col-sm-6 col-lg-3 control-label m-t-10">
                        {!! number_format($loan->balance, 2) !!}
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
                    <h4 class="panel-title">Loan Payment Details</h4>
                </div>

<div class="panel-body">
    <table id="data-table" class="table table-striped table-bordered">
        <thead>
        	<tr>
                <th>#</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Transaction Code</th>
                <th>Payment Mode</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($loan->payments as $key => $payment)
            <tr>
                <td class='table-text'>{{ $key+1 }}</td>
                <td class='table-text'>{{ $payment->date }}</td>
                <td class='table-text'>{{ number_format($payment->amount, 2) }}</td>
                <td class='table-text'>{{ $payment->transaction_number }}</td>
                <td class='table-text'>{{ $payment->mode }}</td>
                <td class='table-text'>{{ number_format($payment->balance, 2) }}</td>
            </tr>
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