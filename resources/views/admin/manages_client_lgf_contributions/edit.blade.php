@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Manages Client Lgf Contributions</a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Manages Client Lgf Contributions Update Form <small>manages client lgf contributions details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('managesclientlgfcontributions.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('managesclientlgfcontributions.update',$managesclientlgfcontributionsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Client" class="col-sm-3 control-label">Client</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="client" id="client">
                                            <option value="" >Select Client</option>				                                @foreach ($managesclientlgfcontributionsdata['clients'] as $clients)
				                                @if( $clients->id  ==  $managesclientlgfcontributionsdata['data']->client  ){
				                                <option selected value="{!! $clients->id !!}" >
								
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>@else
				                                <option value="{!! $clients->id !!}" >
								
				                                {!! $clients->client_number!!}
				                                {!! $clients->first_name!!}
				                                {!! $clients->middle_name!!}
				                                {!! $clients->last_name!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="payment_mode" id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($managesclientlgfcontributionsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $managesclientlgfcontributionsdata['data']->payment_mode  ){
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
                                        <input type="text" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number" value="{!! $managesclientlgfcontributionsdata['data']->transaction_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="{!! $managesclientlgfcontributionsdata['data']->date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="{!! $managesclientlgfcontributionsdata['data']->amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Transaction Status" class="col-sm-3 control-label">Transaction Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control" name="transaction_status" id="transaction_status">
                                            <option value="" >Select Transaction Status</option>				                                @foreach ($managesclientlgfcontributionsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $managesclientlgfcontributionsdata['data']->transaction_status  ){
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
                                            <i class="fa fa-btn fa-plus"></i> Edit Manages Client Lgf Contributions
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