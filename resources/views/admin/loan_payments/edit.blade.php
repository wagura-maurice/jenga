@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Loan Payments</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Loan Payments Update Form <small>loan payments details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('loanpayments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <h4 class="panel-title">DataForm - Autofill</h4>
                </div>
                <div class="panel-body">
                    <form action="{!! route('loanpayments.update',$loanpaymentsdata['data']->id) !!}" method="POST" class="form-horizontal">
                        <input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan" class="col-sm-3 control-label">Loan</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="loan" id="loan">
                                            <option value="" >Select Loan</option>				                                @foreach ($loanpaymentsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $loanpaymentsdata['data']->loan  ){
				                                <option selected value="{!! $loans->id !!}" >
								
				                                {!! $loans->loan_number!!}
				                                </option>@else
				                                <option value="{!! $loans->id !!}" >
								
				                                {!! $loans->loan_number!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Mode Of Payment" class="col-sm-3 control-label">Mode Of Payment</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="mode_of_payment" id="mode_of_payment">
                                            <option value="" >Select Mode Of Payment</option>				                                @foreach ($loanpaymentsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $loanpaymentsdata['data']->mode_of_payment  ){
				                                <option selected value="{!! $paymentmodes->id !!}" >
								
				                                {!! $paymentmodes->name!!}
				                                </option>@else
				                                <option value="{!! $paymentmodes->id !!}" >
								
				                                {!! $paymentmodes->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Number" class="col-sm-3 control-label">Transaction Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number" value="{!! $loanpaymentsdata['data']->transaction_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="{!! $loanpaymentsdata['data']->amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="{!! $loanpaymentsdata['data']->date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Status" class="col-sm-3 control-label">Transaction Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="transaction_status" id="transaction_status">
                                            <option value="" >Select Transaction Status</option>				                                @foreach ($loanpaymentsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $loanpaymentsdata['data']->transaction_status  ){
				                                <option selected value="{!! $transactionstatuses->id !!}" >
								
				                                {!! $transactionstatuses->name!!}
				                                </option>@else
				                                <option value="{!! $transactionstatuses->id !!}" >
								
				                                {!! $transactionstatuses->name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Edit Loan Payments
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script language="javascript" type="text/javascript">
$("#date").datepicker({todayHighlight:!0,autoclose:!0});
</script>
@endsection