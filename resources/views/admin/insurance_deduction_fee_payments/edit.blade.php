@extends("admin.home")
@section("main_content")
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li><a href="#">Home</a></li>
        <li><a href="#">public</a></li>
        <li><a href="#">Insurance Deduction Fee Payments </a></li>
        <li class="active">form</li>
    </ol>
    <h1 class="page-header">Insurance Deduction Fee Payments  Update Form <small>insurance deduction fee payments  details goes here...</small></h1>
    <div class="row">
        <div class="col-md-12">
            <a href="{!! route('insurancedeductionfeepayments.index') !!}"><button type="button" class="btn btn-inverse btn-icon btn-circle m-b-10"><i class="fa fa-arrow-left"></i></button></a>
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
                    <form action="{!! route('insurancedeductionfeepayments.update',$insurancedeductionfeepaymentsdata['data']->id) !!}" method="POST" class="form-horizontal">
<input type="hidden" name="_method" value="put" />
                        {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="Loan  Number" class="col-sm-3 control-label">Loan  Number</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="loan__number" id="loan__number">
                                            <option value="" >Select Loan  Number</option>				                                @foreach ($insurancedeductionfeepaymentsdata['loans'] as $loans)
				                                @if( $loans->id  ==  $insurancedeductionfeepaymentsdata['data']->loan__number  ){
				                                <option selected value="{!! $loans->id !!}" >
								
				                                {!! $loans->loan number!!}
				                                </option>@else
				                                <option value="{!! $loans->id !!}" >
								
				                                {!! $loans->loan number!!}
				                                </option>@endif
				                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Payment Mode" class="col-sm-3 control-label">Payment Mode</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="payment_mode" id="payment_mode">
                                            <option value="" >Select Payment Mode</option>				                                @foreach ($insurancedeductionfeepaymentsdata['paymentmodes'] as $paymentmodes)
				                                @if( $paymentmodes->id  ==  $insurancedeductionfeepaymentsdata['data']->payment_mode  ){
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
                                        <input type="text" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number" value="{!! $insurancedeductionfeepaymentsdata['data']->transaction_number !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Date" class="col-sm-3 control-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="date" id="date" class="form-control" placeholder="Date" value="{!! $insurancedeductionfeepaymentsdata['data']->date !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="{!! $insurancedeductionfeepaymentsdata['data']->amount !!}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Status" class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-6">
									    <select class="form-control selectpicker" data-size="100000" data-live-search="true" data-style="btn-white" name="status" id="status">
                                            <option value="" >Select Status</option>				                                @foreach ($insurancedeductionfeepaymentsdata['transactionstatuses'] as $transactionstatuses)
				                                @if( $transactionstatuses->id  ==  $insurancedeductionfeepaymentsdata['data']->status  ){
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
                                            <i class="fa fa-btn fa-plus"></i> Edit Insurance Deduction Fee Payments 
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
</script>
@endsection